<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $guarded = [];
    protected $casts = ['metadata' => 'array'];
    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = \Str::slug($product->name);
            }
        });
    }
    
    public function category() {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function variants() {
        return $this->hasMany(ProductVariant::class);
    }
    
}
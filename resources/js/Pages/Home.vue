<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    products: Object, // Ini data paginated dari Laravel
    categories: Array
});

// Fungsi format Rupiah
const formatPrice = (price) => {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(price);
};
</script>

<template>
    <AppLayout>
        <Head title="Our Products" />
        
        <div class="max-w-7xl mx-auto py-12 px-6">
            <h1 class="text-4xl font-serif font-black mb-10 uppercase tracking-tighter">Our Collection</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div v-for="product in products.data" :key="product.id" class="group">
                    <div class="aspect-[3/4] overflow-hidden bg-gray-100 mb-4">
                        <img :src="'/storage/' + product.variants[0]?.images[0]?.image_path" 
                             class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-700" />
                    </div>
                    <h3 class="font-bold text-sm uppercase tracking-widest">{{ product.name }}</h3>
                    <p class="text-gray-500">{{ formatPrice(product.variants[0]?.price) }}</p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
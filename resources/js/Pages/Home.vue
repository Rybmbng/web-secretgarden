<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    products: Object,    // Data paginated
    categories: Array    // List kategori untuk filter
});

// Helper Format Rupiah
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
        <Head title="Explore Collection" />
        
        <div class="bg-white min-h-screen">
            <header class="pt-20 pb-10 px-6 md:px-12 max-w-7xl mx-auto border-b border-gray-100">
                <nav class="flex text-[10px] uppercase tracking-widest text-gray-400 mb-6">
                    <Link href="/" class="hover:text-black">Home</Link>
                    <span class="mx-2">/</span>
                    <span class="text-black font-bold">Marketplace</span>
                </nav>
                <h1 class="text-5xl md:text-7xl font-serif font-black uppercase tracking-tighter leading-none mb-4" style="font-family: serif;">
                    Our Collection
                </h1>
                <p class="max-w-xl text-gray-500 italic text-sm md:text-base leading-relaxed">
                    Crafted from the finest ingredients of Bali. Explore our range of body care, wellness, and signature scents designed for your serenity.
                </p>
            </header>

            <div class="sticky top-20 z-40 bg-white/90 backdrop-blur-md border-b border-gray-50">
                <div class="max-w-7xl mx-auto px-6 md:px-12 py-4 flex items-center gap-8 overflow-x-auto no-scrollbar">
                    <Link 
                        href="/products" 
                        class="whitespace-nowrap text-[11px] font-black uppercase tracking-[0.2em] pb-1 border-b-2"
                        :class="!$page.url.includes('category') ? 'border-black text-black' : 'border-transparent text-gray-400 hover:text-black'"
                    >
                        All Products
                    </Link>
                    <Link 
                        v-for="cat in categories" 
                        :key="cat.id"
                        :href="`/products?category=${cat.slug}`"
                        class="whitespace-nowrap text-[11px] font-black uppercase tracking-[0.2em] pb-1 border-b-2 transition-all"
                        :class="$page.url.includes(cat.slug) ? 'border-black text-black' : 'border-transparent text-gray-400 hover:text-black'"
                    >
                        {{ cat.name }}
                    </Link>
                </div>
            </div>

            <main class="max-w-full mx-auto py-12 px-6 md:px-12">
                <div v-if="products.data.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-16">
                    <div v-for="product in products.data" :key="product.id" class="group cursor-pointer">
                        
                        <div class="relative aspect-[3/4] overflow-hidden bg-[#F9F6F1] mb-6 shadow-sm group-hover:shadow-xl transition-all duration-700">
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-all duration-500 z-10"></div>
                            
                            <span v-if="product.is_featured" class="absolute top-4 left-4 z-20 bg-black text-white text-[9px] font-black px-3 py-1 uppercase tracking-widest">
                                Best Seller
                            </span>

                            <img 
                                :src="product.variants[0]?.images[0] ? '/storage/' + product.variants[0].images[0].image_path : '/images/placeholder.jpg'" 
                                :alt="product.name"
                                class="w-full h-full object-cover grayscale group-hover:grayscale-0 scale-100 group-hover:scale-110 transition-all duration-1000"
                            />

                            <div class="absolute bottom-0 left-0 right-0 p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-500 z-20">
                                <button class="w-full bg-white text-black py-3 text-[10px] font-black uppercase tracking-widest border border-black hover:bg-black hover:text-white transition-colors shadow-lg">
                                    Quick View
                                </button>
                            </div>
                        </div>

                        <div class="space-y-1 text-center md:text-left">
                            <p class="text-[9px] text-gray-400 uppercase tracking-widest font-bold">
                                {{ product.category?.name || 'Collection' }}
                            </p>
                            <h3 class="text-lg font-bold text-gray-900 uppercase tracking-tight group-hover:text-gray-600 transition-colors">
                                {{ product.name }}
                            </h3>
                            <p class="text-sm font-medium text-gray-600 italic">
                                {{ product.variants[0] ? formatPrice(product.variants[0].price) : 'Price Contact Us' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div v-else class="py-20 text-center">
                    <p class="text-gray-400 italic">No products found in this collection.</p>
                </div>

                <div v-if="products.links.length > 3" class="mt-20 flex justify-center border-t border-gray-100 pt-10">
                    <div class="flex items-center gap-2">
                        <Component 
                            :is="link.url ? Link : 'span'"
                            v-for="(link, index) in products.links" 
                            :key="index"
                            :href="link.url"
                            v-html="link.label"
                            class="px-4 py-2 text-[10px] font-black tracking-widest uppercase transition-all"
                            :class="{
                                'text-gray-300': !link.url,
                                'bg-[#F2E5D5] text-black shadow-sm': link.active,
                                'hover:bg-gray-100 text-gray-500': link.url && !link.active
                            }"
                        />
                    </div>
                </div>
            </main>
        </div>
    </AppLayout>
</template>

<style scoped>
/* Hide scrollbar for category menu */
.no-scrollbar::-webkit-scrollbar {
    display: none;
}
.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
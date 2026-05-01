<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
  <Head title="Home - Secret Garden" />
<AppLayout>
  <div class="bg-white">
    <!-- SECTION 1: HERO TEXT -->
    <section class="px-6 md:px-20 py-16 grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
      <div>
        <h1 class="font-serif text-5xl md:text-7xl leading-tight text-black tracking-tighter uppercase">
          Inspired by Earth <br />
          Made for <span class="italic font-normal">You</span>
        </h1>
      </div>
      <div class="md:pt-4">
        <p class="text-sm text-gray-600 max-w-md leading-relaxed mb-8">
          Originating in Bali, Secret Garden started its journey in 2016. The journey began with a deep reverence for nature's beauty and a commitment to harnessing its essence for your well-being.
        </p>
        <div class="flex gap-8 border-t border-gray-200 pt-6">
          <Link href="/products" class="text-[10px] font-black uppercase tracking-widest border-b border-black pb-1">Discover Our Products</Link>
          <Link href="/store" class="text-[10px] font-black uppercase tracking-widest border-b border-transparent hover:border-black pb-1 transition-all">Explore Immersive Store</Link>
        </div>
      </div>
    </section>

    <!-- SECTION 2: BIG IMAGE SLIDER (PROMO) -->
    <section class="w-full px-4 md:px-0 relative">
      <div class="aspect-[16/7] w-full overflow-hidden relative group">
        <img src="/images/hero-products.jpg" class="w-full h-full object-cover" alt="Hero Products" />
        
        <!-- Arrow Buttons -->
        <button class="absolute left-10 top-1/2 -translate-y-1/2 opacity-50 hover:opacity-100 transition-opacity">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="1.5"><path d="m15 18-6-6 6-6"/></svg>
        </button>
        <button class="absolute right-10 top-1/2 -translate-y-1/2 opacity-50 hover:opacity-100 transition-opacity">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="1.5"><path d="m9 18 6-6-6-6"/></svg>
        </button>
        
        <!-- Dots -->
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2">
            <span class="w-2 h-2 rounded-full bg-black"></span>
            <span class="w-2 h-2 rounded-full bg-gray-300"></span>
            <span class="w-2 h-2 rounded-full bg-gray-300"></span>
        </div>
      </div>
    </section>

    <!-- SECTION 3: FEATURED COLLECTION (CREAM BACKGROUND) -->
    <section class="bg-[#F2E5D5] px-6 md:px-20 py-24 relative overflow-hidden">
      <!-- Decorative Flower -->
      <img src="/images/flower-sketch.png" class="absolute bottom-0 left-0 w-64 opacity-20 pointer-events-none" />

      <div class="max-w-[1440px] mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16">
          <div class="space-y-4">
            <span class="bg-black text-white px-3 py-1 text-[10px] font-bold tracking-widest uppercase">Featured Collection</span>
            <h2 class="font-serif text-6xl text-black leading-none tracking-tighter">Extrait de <br> Parfum</h2>
            <p class="font-serif italic text-xl">Scent embraced by time</p>
          </div>
          
          <div class="flex gap-8 text-[11px] font-bold uppercase tracking-widest mt-8 md:mt-0">
            <Link href="#" class="border-b border-black">All</Link>
            <Link href="#" class="text-gray-500 hover:text-black">Woman Fragrance</Link>
            <Link href="#" class="text-gray-500 hover:text-black">Unisex Fragrance</Link>
          </div>
        </div>

        <!-- Product Horizontal List -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-12 border-t border-black/10 pt-12">
            <div v-for="n in 4" :key="n" class="space-y-4 group cursor-pointer">
                <div class="h-1 w-full bg-black/5 group-hover:bg-black transition-colors"></div>
                <h3 class="text-sm font-black uppercase">Fragrance Name {{ n }}</h3>
                <p class="text-[10px] text-gray-600 uppercase tracking-tighter">Floral | Gourmand</p>
            </div>
        </div>

        <div class="mt-20 flex justify-center">
            <button class="border border-black px-12 py-3 text-[10px] font-black uppercase tracking-[0.2em] hover:bg-black hover:text-white transition-all">
                View All Products
            </button>
        </div>
      </div>
    </section>

    <!-- SECTION 4: CLEAN BEAUTY (MINT GREEN) -->
    <section class="bg-[#D9EBDC] min-h-[600px] flex items-center relative overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 w-full">
            <div class="relative h-[600px]">
                <img src="/images/clean-beauty.png" class="h-full w-full object-cover" />
            </div>
            <div class="flex flex-col justify-center items-center text-center p-12">
                <span class="bg-black text-white px-3 py-1 text-[10px] font-bold tracking-widest uppercase mb-6">New Collection</span>
                <h2 class="font-serif text-7xl text-black leading-tight mb-4 tracking-tighter">Clean <br> Beauty</h2>
                <p class="font-serif italic text-xl mb-12">Caregiving Purity</p>
                <h3 class="text-5xl font-light tracking-[0.3em] uppercase text-black/80">Series</h3>
            </div>
        </div>
    </section>
  </div>
  </AppLayout>
</template>

<style scoped>
/* Tambahkan font serif jika belum ada di project */
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap');

.font-serif {
  font-family: 'Playfair Display', serif;
}
</style>
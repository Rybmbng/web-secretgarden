<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();

// Ambil data navigation dari props global Inertia
const navigation = computed(() => {
    return page.props.navigation || { header: [], footer: [] };
});

// Helper untuk deteksi halaman aktif biar ada background kremnya (seperti di gambar)
const isPageActive = (url) => {
    return page.url === url;
};
</script>

<template>
    <nav class="bg-white border-b border-gray-100 py-6 px-12 flex items-center justify-between sticky top-0 z-50">
        
        <div class="flex-shrink-0">
            <Link href="/" class="flex flex-col items-start">
                <span class="text-xl font-serif font-black tracking-tighter leading-none text-black">SECRET</span>
                <span class="text-xl font-serif font-black tracking-[0.15em] leading-none text-black">GARDEN</span>
            </Link>
        </div>

        <div class="hidden md:flex items-center gap-10">
            <Link 
                v-for="item in navigation.header" 
                :key="item.label" 
                :href="item.url"
                class="font-black text-[11px] uppercase tracking-[0.2em] transition-all duration-300 px-3 py-1 rounded-sm"
                :class="isPageActive(item.url) ? 'bg-[#F2E5D5] text-black' : 'text-black hover:text-gray-500'"
            >
                {{ item.label }}
            </Link>
        </div>

        <div class="flex items-center gap-6 text-black">
            <div class="flex items-center gap-2 text-[10px] font-bold">
                <span class="text-gray-300 cursor-pointer hover:text-black">ID</span>
                <span class="text-black border-b border-black">EN</span>
            </div>

            <button class="hover:scale-110 transition p-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            </button>

            <button class="hover:scale-110 transition p-1 relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
            </button>

            <button class="hover:scale-110 transition p-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </button>
        </div>
    </nav>
</template>

<style scoped>
/* Pakai font yang mirip dengan gambar */
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@900&display=swap');

.font-serif {
    font-family: 'Playfair Display', serif;
}
</style>
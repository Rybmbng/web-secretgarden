<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();

const logo = computed(() => page.props.app?.logo || '/images/logo.png');

const navigation = computed(() => {
    return page.props.navigation || { header: [], footer_columns: [] };
});

const isPageActive = (url) => {
    if (url === '/' && page.url === '/') return true;
    if (url !== '/' && page.url.startsWith(url)) return true;
    return false;
};

</script>

<template>
    <nav class="sticky top-0 z-50 w-full bg-white px-6 md:px-12 py-4 flex items-center justify-between border-b border-gray-100">
        
        <div class="flex items-center w-[131px]">
            <Link href="/" class="block w-full">
                <img 
                    :src="logo" 
                    alt="Secret Garden Logo" 
                    class="w-full h-auto object-contain object-left"
                />
            </Link>
        </div>

        <div class="hidden lg:flex items-center gap-2">
            <Link 
                v-for="(item, index) in navigation.header" 
                :key="index" 
                :href="item.url"
                class="px-4 py-2 text-[11px] font-black uppercase tracking-[0.2em] transition-all duration-300 rounded-sm"
                :class="isPageActive(item.url) 
                    ? 'bg-[#F2E5D5] text-black' 
                    : 'text-black hover:text-gray-400'"
            >
                {{ item.label }}
            </Link>
        </div>

        <div class="flex items-center gap-5">
            <div class="hidden md:flex items-center gap-2 text-[10px] font-black tracking-tighter">
                <span class="text-gray-300 cursor-pointer hover:text-black uppercase">ID</span>
                <span class="text-black border-b border-black cursor-default font-black uppercase">EN</span>
            </div>

            <button class="p-1 text-black hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            </button>

            <button class="p-1 text-black hover:scale-110 transition-transform relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
            </button>

            <button class="p-1 text-black hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </button>
        </div>
    </nav>
</template>
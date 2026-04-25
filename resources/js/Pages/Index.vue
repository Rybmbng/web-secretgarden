<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

// Sekarang terima 'pages' sebagai Array
defineProps({
    pages: Array 
});
</script>

<template>
    <AppLayout>
        <Head title="Secret Garden Story" />

        <div class="bg-[#F9F6F1] min-h-screen">
            <div v-for="page in pages" :key="page.id" class="border-b border-black/5">
                
                <div class="max-w-7xl mx-auto px-6 py-20">
                    <template v-for="(block, index) in page.content" :key="index">
                        
                        <section v-if="block.type === 'hero_text'" class="text-center mb-24">
                            <span class="uppercase tracking-[0.5em] text-gray-500 text-xs block mb-4 italic">
                                {{ block.data.sub_title }}
                            </span>
                            <h2 class="text-6xl font-serif font-black uppercase">
                                {{ block.data.main_title }}
                            </h2>
                        </section>

                        <section v-if="block.type === 'image_content'" 
                            :class="['flex flex-col md:flex-row items-center gap-16 mb-32', 
                                    block.data.layout === 'right' ? 'md:flex-row-reverse' : '']">
                            
                            <div class="w-full md:w-1/2 shadow-xl">
                                <img :src="'/storage/' + block.data.image" class="w-full grayscale hover:grayscale-0 transition duration-1000" />
                            </div>
                            
                            <div class="w-full md:w-1/2">
                                <h3 class="text-4xl font-serif font-bold mb-6">{{ block.data.title }}</h3>
                                <div class="prose prose-neutral italic text-gray-700" v-html="block.data.body"></div>
                            </div>
                        </section>

                    </template>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
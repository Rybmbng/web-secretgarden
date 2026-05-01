<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    pages: Array
});
</script>

<template>
    <AppLayout>
        <Head title="Secret Garden Story" />

        <div class="bg-white text-black w-full select-none">

            <div v-for="page in pages" :key="page.id">

                <section v-for="(block, index) in page.content" :key="index">

                    <!-- HERO -->
                    <div v-if="block.type === 'hero_text'" class="text-center pt-16 pb-10 px-4 max-w-3xl mx-auto">
                        <p class="uppercase text-[10px] tracking-[0.4em] text-gray-500">
                            {{ block.data.sub_title }}
                        </p>
                        <h1 class="text-3xl md:text-5xl font-serif leading-tight uppercase">
                            {{ block.data.main_title }}
                        </h1>
                    </div>

                    <div 
                        v-if="block.type === 'image_content'"
                        class="w-full flex flex-col md:flex-row items-start "
                        :class="block.data.layout === 'image_right' ? 'md:flex-row-reverse' : ''"
                    >
                        
                        <div class="w-full md:w-7/12">
                            <img 
                                :src="'/storage/' + block.data.image" 
                                class="w-full h-full md:h-full object-cover "
                            />
                        </div>

                        <!-- TEXT -->
                        <div class="w-full md:w-5/12">
                            <div class="p-4 md:p-6">
                                <h2 class="text-xl md:text-3xl font-serif mb-4 leading-tight">
                                    {{ block.data.title }}
                                </h2>
                                <div 
                                    class="text-sm md:text-base text-gray-700 leading-relaxed space-y-3"
                                    v-html="block.data.body"
                                ></div>
                            </div>
                        </div>

                    </div>

                    <!-- CTA -->
                    <div v-if="block.type === 'cta'" class="w-full px-4 md:px-10 py-12 border-t border-gray-100">
                        <div class="grid md:grid-cols-2 gap-8 items-start">
                            
                            <div>
                                <h3 class="text-xl md:text-3xl font-serif mb-4 uppercase">
                                    {{ block.data.title }}
                                </h3>
                                <button class="border border-black px-6 py-2 text-[10px] tracking-[0.2em] uppercase">
                                    {{ block.data.button_text }}
                                </button>
                            </div>

                            <div>
                                <p class="text-sm md:text-base text-gray-600 italic leading-relaxed">
                                    {{ block.data.description }}
                                </p>
                            </div>

                        </div>
                    </div>

                </section>

            </div>

        </div>
    </AppLayout>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,900;1,700&display=swap');

:deep(.prose p), :deep(p) {
    margin-bottom: 1rem;
}
</style>
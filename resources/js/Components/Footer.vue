<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();

const footerColumns = computed(() => {
    return page.props.navigation?.footer_columns || [];
});
</script>

<template>
    <footer class="bg-[#F2E5D5] w-full mt-20 border-t border-black/5">
        <div class="w-full px-6 md:px-20 py-20">
            <div class="max-w-[1440px] mx-auto grid grid-cols-1 md:grid-cols-12 gap-16">
                
                <div class="md:col-span-4 space-y-6">
                    <h2 class="font-serif text-5xl font-medium leading-[0.8] text-black tracking-tighter uppercase">
                        SECRET <br> GARDEN
                    </h2>
                    <p class="text-black text-sm font-serif italic leading-relaxed">
                        inspired by <span class="font-bold">earth</span>, made for <span class="font-bold text-lg">You</span>
                    </p>
                </div>

                <div class="md:col-span-8 grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div v-for="(col, i) in footerColumns" :key="i">
                        <h4 class="font-bold text-sm mb-6 text-black uppercase tracking-tight">
                            {{ col.column_title }}
                        </h4>
                        <ul class="space-y-4">
                            <li v-for="(link, j) in col.links" :key="j">
                                <a 
                                    :href="link.url" 
                                    class="text-gray-700 hover:text-black text-sm flex items-center gap-2 transition-all group"
                                >
                                    <i v-if="link.icon" :class="link.icon" class="text-xs group-hover:scale-110 transition-transform"></i>
                                    <span>{{ link.label }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        
        <div class="w-full h-2 bg-black"></div>
    </footer>
</template>
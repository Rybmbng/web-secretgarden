<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();

// Pengaman biar gak undefined
const navigation = computed(() => page.props.navigation || { header: [], footer: [] });
</script>

<template>
    <footer class="bg-[#F2E5D5] pt-20 pb-10 px-20">
        <div v-for="section in navigation.footer" :key="section.title">
            <h4 class="font-bold text-lg mb-6">{{ section.title }}</h4>
            <ul class="space-y-3">
                <li v-for="link in section.links" :key="link.label">
                    <a :href="link.url">{{ link.label }}</a>
                </li>
            </ul>
        </div>
    </footer>
</template>
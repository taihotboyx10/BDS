<template>
    <div class="w-full flex items-center justify-center mt-6 gap-2">
        <Link :href="listings.first_page_url" v-html="'&laquo;&laquo;'"
            :class="[
                'px-3 py-1 rounded-md border border-gray-300 dark:border-gray-600',
                'bg-white text-gray-700 hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700',
                listings.prev_page_url === null ? 'pointer-events-none opacity-50' : '',
                ]">
        </Link>
        <Link
            v-for="(link, index) in listings.links"
            :key="index"
            :href="link.url ? link.url : ''"
            v-html="sliceLabels(link.label)"
            :class="[
                'px-3 py-1 rounded-md border border-gray-300 dark:border-gray-600',
                link.active
                    ? 'bg-blue-500 text-white dark:bg-blue-600'
                    : 'bg-white text-gray-700 hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700',
                link.url ? '' : 'pointer-events-none opacity-50',
            ]"
        />
        <Link :href="listings.last_page_url" v-html="'&raquo;&raquo;'"
            :class="[
                'px-3 py-1 rounded-md border border-gray-300 dark:border-gray-600',
                'bg-white text-gray-700 hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700',
                listings.next_page_url === null ? 'pointer-events-none opacity-50' : '',
            ]">
        </Link>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    listings: Object,
});

function sliceLabels(label) {
    if (label.includes('Previous')) {
        return label.replace(' Previous', '');
    }
    else if (label.includes('Next')) {
        return label.replace('Next ', '');
    }
    else return label;
}
</script>
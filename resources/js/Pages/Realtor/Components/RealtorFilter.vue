<template>
    <form>
        <div class="flex items-center gap-2 mb-2">
            <div class="flex items-center gap-1">
                <input v-model="filters.deleted" id="deleted" type="checkbox"
                    class="h-4 w-4 rounded border-slate-300 text-sky-600 focus:ring-sky-500 dark:border-slate-600 dark:bg-slate-800">
                <label for="deleted">deleted</label>
            </div>

            <div>
                <select v-model="filters.sortBy">
                    <option v-for="(sortBy, idx) in sortByOptions" :key="idx" :value="sortBy.value">{{ sortBy.label }}</option>
                </select>
            </div>

            <div>
                <select v-model="filters.sortStyle">
                    <div v-if="filters.sortBy === 'price'">
                        <option v-for="(sortStyle, idx) in sortStyleOptions[0].price" :key="idx" :value="sortStyle.value">{{ sortStyle.label }}</option>
                    </div>
                    <div v-else-if="filters.sortBy === 'created_at'">
                        <option v-for="(sortStyle, idx) in sortStyleOptions[1].created_at" :key="idx" :value="sortStyle.value">{{ sortStyle.label }}</option>
                    </div>
                </select>
            </div>
        </div>
    </form>
</template>

<script setup>
import { reactive, watch, onBeforeUnmount } from 'vue';
import { router } from '@inertiajs/vue3';
import debounce from 'lodash/debounce';

const sortByOptions = [
    { value: 'price', label: 'Price' },
    { value: 'created_at', label: 'Added' },
];
const sortStyleOptions = [
    {
        price: [
            { value: 'desc', label: 'Highest' },
            { value: 'asc', label: 'Lowest' }
        ]
    },
    {
        created_at: [
            { value: 'desc', label: 'Lastest' },
            { value: 'asc', label: 'Oldest' }
        ]
    }
];

const props = defineProps({
    filterParams: Object,
});
const filters = reactive({
    deleted: props.filterParams.deleted ?? false,
    sortBy: props.filterParams.sortBy ?? 'created_at',
    sortStyle: props.filterParams.sortStyle ?? 'desc'
});

const debouncedFilter = debounce((filters) => {
    router.get(route('realtor.listing.index'), filters, {
        preserveState: true,
        preserveScroll: true,
    });
}, 1000);

watch(() => ({ ...filters }),
    (newFilters) => {
        debouncedFilter(newFilters);
    }
);

onBeforeUnmount(() => {
    debouncedFilter.cancel();
});


</script>
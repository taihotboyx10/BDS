<template>
    <form @submit.prevent="filter" @reset.prevent="reset">
        <div class="mt-2 mb-4 flex flex-wrap gap-3">
            <div class="flex flex-nowrap items-center gap-1">
                <input v-model.number="form.price_from" class="form-input" type="text" placeholder="price from">
                <input v-model.number="form.price_to" class="form-input" type="text" placeholder="price to">
            </div>

            <div class="flex flex-nowrap items-center gap-1">
                <select v-model.number="form.beds" name="" id="">
                    <option value="null">Beds</option>
                    <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                </select>
                <select v-model.number="form.baths" name="" id="">
                    <option value="null">Baths</option>
                    <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                </select>
            </div>

            <div class="flex flex-nowrap items-center gap-1">
                <input v-model.number="form.area_from" class="form-input" type="text" placeholder="area from">
                <input v-model.number="form.area_to" class="form-input" type="text" placeholder="area to">
            </div>

            <div class="flex flex-nowrap items-center gap-1">
                <button class="submit-btn" type="submit">Filter</button>
                <button class="submit-btn" type="reset">Clear</button>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

const props = defineProps({
    filters: Object,
});

const form = useForm({
    price_from: props.filters.price_from ?? '',
    price_to: props.filters.price_to ?? '',
    beds: props.filters.beds ?? null,
    baths: props.filters.baths ?? null,
    area_from: props.filters.area_from ?? '',
    area_to: props.filters.area_to ?? '',
});

const filter = () => {
    form.get(route('listings.index'), {
        preserveState: true,
        preserveScroll: true,
    });
};

const reset = () => {
    form.price_from = '';
    form.price_to = '';
    form.beds = null;
    form.baths = null;
    form.area_from = '';
    form.area_to = '';
    
    // refilter the listings after resetting the form
    filter();
};
</script>
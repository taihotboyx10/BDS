<template>
    <div v-for="listing in listings" :key="listing.id">
        <div>
            <Link :href="route('listings.show', listing.id)">
                <ListingAddress :listing="listing" />
            </Link>
        </div>

        <div>
            <Link :href="route('listings.edit', listing.id)">Edit</Link>
        </div>

        <div>
            <Link :href="route('listings.destroy', listing.id)" method="delete" as="button">Delete</Link>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import ListingAddress from '../../Components/ListingAddress.vue';
import { route } from 'ziggy-js';

defineProps({
    listings: Array,
});
</script>
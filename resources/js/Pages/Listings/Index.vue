<template>
    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        <Box v-for="listing in listings" :key="listing.id">
            <div>
                <Link :href="route('listings.show', listing.id)">
                    <ListingPrice :price="listing.price" class="font-bold text-2xl"/>
                    <ListingInfo :listing="listing" class="font-bold text-lg"/>
                    <ListingAddress :listing="listing" class="text-gray-700 dark:text-gray-200"/>
                </Link>
            </div>
    
            <div>
                <Link :href="route('listings.edit', listing.id)">Edit</Link>
            </div>
    
            <div>
                <Link :href="route('listings.destroy', listing.id)" method="delete" as="button">Delete</Link>
            </div>
        </Box>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import ListingAddress from '../../Components/ListingAddress.vue';
import { route } from 'ziggy-js';
import Box from '../../Components/UI/Box.vue';
import ListingInfo from '../../Components/ListingInfo.vue';
import ListingPrice from '../../Components/ListingPrice.vue';

defineProps({
    listings: Array,
});
</script>
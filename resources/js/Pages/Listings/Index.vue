<template>
    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        <ListingMain v-for="listing in listings" :key="listing.id" :listing="listing">
        </ListingMain>
    </div>
</template>

<script setup>
import ListingMain from './Components/ListingMain.vue';

defineProps({
    listings: Array,
});
</script>
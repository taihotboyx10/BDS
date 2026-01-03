<template>
    <Filter :filters="filters"></Filter>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
        <ListingMain v-for="listing in listings.data" :key="listing.id" :listing="listing">
        </ListingMain>
    </div>

    <Pagination :listings="listings" v-if="listings.data.length"/>
</template>

<script setup>
import Pagination from '../../Components/UI/Pagination.vue';
import Filter from './Components/Filter.vue';
import ListingMain from './Components/ListingMain.vue';

defineProps({
    listings: Object,
    filters: Object,
});


</script>
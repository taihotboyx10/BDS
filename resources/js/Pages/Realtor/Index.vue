<template>
    <h1 class="text-3xl mb-4 font-bold">My listings</h1>

    <section>
        <RealtorFilter :filterParams="filterParams"></RealtorFilter>
    </section>

    <section class="grid md:grid-cols-2 gap-4">
        <Box v-for="listing in listings.data" :key="listing.id">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <div class="flex flex-col">
                    <div class="flex flex-col lg:flex-row lg:items-center gap-2">
                        <ListingPrice :price="listing.price" class="font-bold text-lg"></ListingPrice>
                        <ListingInfo :listing="listing" class="text-sm"></ListingInfo>
                    </div>
                    <div class="mt-2">
                        <ListingAddress :listing="listing" class="text-sm"></ListingAddress>
                    </div>
                    <div class="form-error" v-if="listing.deleted_at">This listing has been deleted.</div>
                </div>
                <div class="flex items-center gap-1" v-if="!listing.deleted_at">
                    <a class="link-btn" :href="route('realtor.listing.show', listing.id)" target="_blank">preview</a>
                    <Link class="link-btn" :href="route('realtor.listing.edit', listing.id)">edit</Link>
                    <Link class="submit-btn" :href="route('realtor.listing.destroy', listing.id)" method="delete" as="button">delete</Link>
                </div>
                <div v-else>
                    <Link class="submit-btn" :href="route('realtor.listing.restore', listing.id)" method="put" as="button">restore</Link>
                </div>
            </div>
        </Box>
    </section>

    <section v-if="listings.data.length">
        <Pagination :listings="listings"></Pagination>
    </section>

</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import ListingAddress from '../../Components/ListingAddress.vue';
import ListingInfo from '../../Components/ListingInfo.vue';
import ListingPrice from '../../Components/ListingPrice.vue';
import Box from '../../Components/UI/Box.vue';
import RealtorFilter from './Components/RealtorFilter.vue';
import Pagination from '../../Components/UI/Pagination.vue';

defineProps({
    filterParams: Object,
    listings: Object
});
</script>
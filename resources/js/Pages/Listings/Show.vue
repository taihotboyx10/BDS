<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box class="md:col-span-7 sm:col-span-12 flex items-center justify-center">
            <div class="">
                No images
            </div>
        </Box>
        <Box class="md:col-span-5 sm:col-span-12 ">
            <Box>
                <template #header>
                    Listing information
                </template>
                <ListingPrice :price="listing.price" class="font-bold text-2xl" />
                <ListingInfo :listing="listing" class="font-bold text-lg" />
                <ListingAddress :listing="listing" class="text-gray-700 dark:text-gray-200" />
            </Box>
            <Box class="mt-4">
                <div>Make an offer</div>
            </Box>
        </Box>
    </div>
</template>

<script setup>
import ListingAddress from '../../Components/ListingAddress.vue';
import ListingInfo from '../../Components/ListingInfo.vue';
import ListingPrice from '../../Components/ListingPrice.vue';
import Box from '../../Components/UI/Box.vue';

defineProps({
    listing: Object,
});
</script>

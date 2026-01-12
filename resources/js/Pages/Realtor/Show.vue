<template>
    <div class="mb-4">
        <Link :href="route('realtor.listing.index')">🔙Go back to listings</Link>
    </div>
    <div class="flex flex-col-reverse md:grid md:grid-cols-2 gap-4">
        <div class="flex flex-col gap-2">
            <div v-if="listing.offers.length">
                <Box v-for="(offer, idx) in listing.offers" :key="idx">
                    <template #header>
                        <div class="inline-flex gap-1 items-center">
                            offer #{{ idx + 1 }}
                            <div v-if="offer.acceped_at" class="accepted-label text-sm!">ACCEPTED</div>
                        </div>
                    </template>
                    <div class="flex items-center justify-between">
                        <div>
                            <ListingPrice :price="offer.amount" class="font-bold text-lg"></ListingPrice>
                            <div class="inline-flex gap-1 items-center">difference
                                <ListingPrice :price="offer.amount - listing.price"></ListingPrice>
                            </div>
                            <div>made by {{ offer.user.name }}</div>
                            <div>made on {{ useConvertDate(offer.created_at) }}</div>
                        </div>
                        <form @submit.prevent="acceptOffer(offer.id)">
                            <button type="submit"
                                :class="['submit-btn w-24 flex justify-center',
                                    listing.is_solded ? 'opacity-50 cursor-not-allowed' : ''
                                ]"
                                :disabled="listing.is_solded">
                                Accept
                            </button>
                        </form>
                    </div>
                </Box>
            </div>
            <Box v-else>No offers</Box>
        </div>
        <div>
            <Box>
                <template #header>Listing basic infor</template>
                <div class="flex items-center gap-2">
                    <ListingPrice :price="props.listing.price" class="font-bold text-2xl" />
                </div>
                <ListingInfo :listing="props.listing" class="font-bold text-lg" />
                <ListingAddress :listing="listing" class="text-gray-700 dark:text-gray-200" />
            </Box>
        </div>
    </div>

</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import Box from '@/Components/UI/Box.vue';
import ListingPrice from '@/Components/ListingPrice.vue';
import ListingInfo from '@/Components/ListingInfo.vue';
import ListingAddress from '@/Components/ListingAddress.vue';
import { useConvertDate } from '@/Composables/useConvertDate';
import { route } from 'ziggy-js';

const props = defineProps({
    listing: Object
})
const form = useForm({});

const acceptOffer = (id) => {
    if (props.listing.is_solded) {
        return;
    }

    form.put(route('realtor.accept.offer', id));
}
</script>
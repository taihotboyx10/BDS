<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box class="md:col-span-7 sm:col-span-12 flex items-center justify-center">
            <div class="">
                No images(TODO: use swiper to display images)
            </div>
        </Box>
        <Box class="md:col-span-5 sm:col-span-12 ">
            <Box>
                <template #header>
                    Listing information
                </template>
                <ListingPrice :price="props.listing.price" class="font-bold text-2xl" />
                <ListingInfo :listing="props.listing" class="font-bold text-lg" />
                <ListingAddress :listing="props.listing" class="text-gray-700 dark:text-gray-200" />
            </Box>
            <Box class="mt-4">
                <template #header>
                    Monthly payment estimate
                </template>
                <div class="flex flex-col mb-2">
                    <label for="">Interest rate ({{ interestRate }}%)</label>
                    <input v-model="interestRate" type="range" min="0.1" max="30" step="0.1" class="cursor-pointer">
                </div>
                <div class="flex flex-col mb-2">
                    <label for="">Duration ({{ durationYears }} year)</label>
                    <input v-model="durationYears" type="range" min="3" max="35" step="1" class="cursor-pointer">
                </div>

                <div class="mb-2">
                    <div class="">Your monthly payment estimate:</div>
                    <ListingPrice :price="monthlyPayment" class="font-bold text-2xl" />
                </div>

                <div>
                    <div class="flex justify-between">
                        <div>Total paid:</div>
                        <ListingPrice :price="totalPaid" class="text-md" />
                    </div>
                    <div class="flex justify-between">
                        <div>Principal price:</div>
                        <ListingPrice :price="offer" class="text-md" />
                    </div>
                    <div class="flex justify-between">
                        <div>Interest paid:</div>
                        <ListingPrice :price="totalInterest" class="text-md" />
                    </div>
                </div>

                <!-- make offer -->
                <MakeOffer @updated-offer="offer = $event" v-if="authUser" class="mt-4"
                    :listingPrice="props.listing.price" :listingId="props.listing.id" :offer="props.offer" :listingUserId="listing.user_id"></MakeOffer>
            </Box>
        </Box>
    </div>
</template>

<script setup>
import ListingAddress from '@/Components/ListingAddress.vue';
import ListingInfo from '@/Components/ListingInfo.vue';
import ListingPrice from '@/Components/ListingPrice.vue';
import Box from '@/Components/UI/Box.vue';
import { ref } from 'vue';
import { useMonthlyPayment } from '@/Composables/useMonthlyPayment';
import MakeOffer from './Components/MakeOffer.vue';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const authUser = computed(() => page.props.auth.user);
const interestRate = ref(2.5);
const durationYears = ref(25);
const props = defineProps({
    listing: Object,
    offer: Object
});

const offer = ref(props.listing.price)
const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(
    offer,
    interestRate,
    durationYears
);
</script>

<template>
    <Box>
        <div>
            <Link :href="route('realtor.listing.show', listing.id)">
                <div class="flex items-center gap-2">
                    <ListingPrice :price="listing.price" class="font-bold text-2xl" />
                    <ListingPrice :price="monthlyPayment" class="text-md text-gray-500 dark:text-gray-200" />
                </div>
                <ListingInfo :listing="listing" class="font-bold text-lg" />
                <ListingAddress :listing="listing" class="text-gray-700 dark:text-gray-200" />
            </Link>
        </div>

        <div>
            <Link v-if="authUser ? authUser.id === listing.user_id : authUser" :href="route('realtor.listing.edit', listing.id)">Edit</Link>
        </div>

        <div>
            <Link v-if="authUser ? authUser.id === listing.user_id : authUser" :href="route('realtor.listing.destroy', listing.id)" method="delete" as="button">Delete</Link>
        </div>
    </Box>
</template>

<script setup>
import { Link,usePage } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import Box from '../../../Components/UI/Box.vue';
import ListingAddress from '../../../Components/ListingAddress.vue';
import ListingInfo from '../../../Components/ListingInfo.vue';
import ListingPrice from '../../../Components/ListingPrice.vue';
import { useMonthlyPayment } from '../../../Composables/useMonthlyPayment';
import { computed } from 'vue';

const props = defineProps({
    listing: Object,
});
const { monthlyPayment } = useMonthlyPayment(
    props.listing.price,
    2.5,
    30
);
const page = usePage();
const authUser = computed(() => page.props.auth.user);
</script>
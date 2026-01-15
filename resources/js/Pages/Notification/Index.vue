<template>
    <h1 class="h1-heading">Your Notifications</h1>
    <section v-if="props.notifications.length">
        <div v-for="(noti, idx) in props.notifications" :key="idx">
            <div v-if="!noti.read_at" class="flex items-center justify-between p-4 border-gray-300 border-b">
                <div class="flex gap-1">
                    Offer<ListingPrice :price="noti.data.amount"></ListingPrice>
                    for<Link :href="route('realtor.listing.show', noti.data.listing_id)" class="text-blue-700 underline">listing</Link>
                    was made
                </div>
                <Link class="link-btn" :href="route('notification.update', noti.id)" method="put" as="button">Mark as read</Link>
            </div>
        </div>
    </section>
    <section v-else>
        <div class="no-item-found">No notification</div>
    </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import ListingPrice from '../../Components/ListingPrice.vue';

const props = defineProps({
    notifications: Array
}
)
</script>
<template>
    <Box>
        <template #header>{{ props.offer ? 'Made offer' : 'Make your offer' }}</template>
        <div v-if="props.offer">
            <ListingPrice :price="props.offer.amount" class="text-2xl"></ListingPrice>
            <div class="flex justify-between">
                <label class="form-label">Made on</label>
                <span>{{ useConvertDate(props.offer.created_at) }}</span>
            </div>
        </div>
        <div v-else>
            <div>
                <form class="flex flex-col gap-2" @submit.prevent="submit">
                    <input type="text" class="form-input" v-model.number="form.amount">
                    <input type="range" class="" v-model.number="form.amount" :min="min" :max="max" step="1">
                    <button type="submit" class="submit-btn">Make an offer</button>
                    <div class="form-error">{{ form.errors.amount }}</div>
                    <div v-if="form.errors.amount" class="form-error">{{ form.errors.amount }}</div>
                    <div v-if="errorMsg" class="form-error">{{ errorMsg }}</div>
                </form>
            </div>
            <div class="flex justify-between mt-3">
                <label class="form-label">Difference</label>
                <ListingPrice :price="difference"></ListingPrice>
            </div>
        </div>
    </Box>
</template>

<script setup>
import { useForm, usePage} from '@inertiajs/vue3';
import ListingPrice from '@/Components/ListingPrice.vue';
import Box from '@/Components/UI/Box.vue';
import { computed, watch } from 'vue';
import { route } from 'ziggy-js';
import { useConvertDate } from '@/Composables/useConvertDate';
import { ref } from 'vue';

const page = usePage();
const authUser = computed(() => page.props.auth.user);
const props = defineProps({
    listingId: Number,
    listingPrice: Number,
    listingUserId: Number,
    offer: Object
})
const form = useForm({
    amount: props.listingPrice,
})
const difference = computed(() => form.amount - props.listingPrice);
const min = computed(() => Math.round(props.listingPrice*3/4));
const max = computed(() => props.listingPrice*2);
const errorMsg = ref('');

const submit = () => {
    if (authUser.value?.id === props.listingUserId){
        errorMsg.value = 'You cannot make an offer on your own listing.'
        return;
    }

    form.post(route('listing.offer.store', props.listingId), 
    {
        preserveScroll: true,
        preserveState: true,
        onError: (errors) => {
            if (errors.message){
                errorMsg.value = errors.message;
            }
        }
    });
}

const emit = defineEmits(['updatedOffer']);
watch(() => form.amount, (value) => emit('updatedOffer', value));
</script>
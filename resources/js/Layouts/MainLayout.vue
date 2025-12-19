<template>
    <Link :href="route('listings.index')">Listings</Link>
    <Link :href="route('listings.create')">Create new listing</Link>

    <!-- flash message or other global components can be added here -->
    <div>
        <p v-if="msgSuccess" class="text-green-500 p-2 bg-amber-50">{{ msgSuccess }}</p>
        <p v-if="msgError" class="text-red-500 p-2 bg-amber-50">{{ msgError }}</p>
    </div>

    <slot></slot>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();

const msgSuccess = computed(() => page.props.flash.success);
const msgError = computed(() => page.props.flash.error);

</script>
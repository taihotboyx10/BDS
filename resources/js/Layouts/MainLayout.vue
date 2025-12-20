<template>
    <header class="border-b border-gray-200 dark:border-gray-700 w-full">
        <div class="container mx-auto">
            <nav class="p-4 flex items-center justify-between">
                <div class="text-lg font-bold">
                    <Link :href="route('listings.index')">Listings</Link>
                </div>
                <div class="text-lg font-bold text-sky-900 dark:text-sky-200">
                    <Link :href="route('listings.index')">BDS</Link>
                </div>
                <div class="text-lg">
                    <Link :href="route('listings.create')" class="link-btn">
                       + New listing
                    </Link>
                </div>
            </nav>
        </div>
    </header>

    <main class="container mx-auto mt-4">
        <!-- flash message or other global components can be added here -->
        <div>
            <p v-if="msgSuccess" class="border rounded-sm text-green-500 p-2 bg-amber-50">{{ msgSuccess }}</p>
            <p v-if="msgError" class="border rounded-sm text-red-500 p-2 bg-amber-50">{{ msgError }}</p>
        </div>
        
        <!-- children content -->
        <slot></slot>
    </main>

</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();

const msgSuccess = computed(() => page.props.flash.success);
const msgError = computed(() => page.props.flash.error);

</script>
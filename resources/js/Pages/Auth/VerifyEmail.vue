<template>
    <div class="flex items-center">
        <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
            <h2 class="text-xl font-semibold mb-4">Verify Your Email</h2>
            <p class="text-gray-600 mb-4">Please check your email for a verification link.</p>
            <Link :href="route('verification.resend')" method="post" as="button"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                >Resend verification email</Link>

        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

</script>
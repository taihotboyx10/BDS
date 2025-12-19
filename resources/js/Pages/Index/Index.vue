<template>
    <!-- use default layout in app.js -->
    <div>
        <p>Index page</p>
        <div>
            <p>Hello, {{ name }}!</p>
        </div>
        <Link href="/show">Go to show page</Link>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    name: {
        type: String,
        required: true
    }
});
</script>
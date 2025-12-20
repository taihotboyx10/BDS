<template>
    <div class="border rounded-md border-gray-200 dark:border-gray-700 shadow-sm p-4">
        <div class="text-lg mb-2">
            <slot name="header"></slot>
        </div>
        <slot></slot>
    </div>
</template>

<script setup></script>
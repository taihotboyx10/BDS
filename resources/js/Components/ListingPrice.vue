<template>
    <div>
        {{ price.toLocaleString('ja-JP', {
            style: 'currency',
            currency: 'JPY'
        }) }}
    </div>
</template>

<script setup>
defineProps({
    price: Number,
});
</script>
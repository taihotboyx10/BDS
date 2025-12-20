<template>
    <div>
        {{ listing.beds }} beds • {{ listing.baths }} baths • {{ listing.area }} m²
    </div>
</template>

<script setup>
defineProps({
    listing: Object,
});
</script>
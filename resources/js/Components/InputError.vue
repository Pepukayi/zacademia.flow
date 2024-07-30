<script setup>
defineProps({
    message: String,
});
</script>

<template>
    <div v-show="message">
        <p class="text-red-500 text-xs mt-1">
            {{ message }}
        </p>
    </div>
</template>

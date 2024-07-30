<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
    rows: Number
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <textarea
        :rows="rows"
        ref="input"
        class="block rounded-lg border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    />
</template>

<template>
    <select
        v-model="modelValue"
        @change="$emit('update:modelValue', modelValue)"
        :id="`${props.name}`"
        :name="props.name"
        autocomplete="name"
        class="rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-dark sm:text-sm sm:leading-6"
    >
        <option v-for="option in options" :value="option.name">
            {{ option.name }}
        </option>
    </select>
</template>

<script setup>
import { onMounted, ref } from 'vue';


let props = defineProps({
    // modelValue: String,
    label: String,
    name: String,
    options: Object
});

defineEmits(['update:modelValue']);

const modelValue = ref(null)
</script>

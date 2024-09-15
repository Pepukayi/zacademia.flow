<template>
    <fieldset>
        <div class="mt-1 space-y-2">
            <div v-for="option in options" class="flex items-center">
                <input
                    v-model="modelValue"
                    @change="$emit('update:modelValue', modelValue)"
                    :value="option.name"
                    :id="`${props.name}`"
                    :name="props.name"
                    type="radio" class="h-4 w-4 border-gray-300 text-mostepe-green-dark focus:ring-mostepe-green-dark" />
                <label class="ml-3 block text-sm font-medium leading-6 text-gray-900">{{ option.name }}</label>
            </div>
        </div>
    </fieldset>
</template>

<script setup>

const props = defineProps({
    // modelValue: String,
    name: String,
    options: Object
})
const emit = defineEmits(['update:modelValue'])
// const modelValue = ref(props.options[0].name)

</script>

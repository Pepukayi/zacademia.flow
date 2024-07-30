<template>
    <RadioGroup
        v-model="modelValue"
                :modelValue="modelValue"
                @update:modelValue="value => emit('update:modelValue', value)"
                 class="w-96">
        <!--                                    <RadioGroupLabel class="sr-only">Server size</RadioGroupLabel>-->
        <div class="space-y-4">
            <RadioGroupOption as="template" v-for="option in options" :key="option.name" :value="option.name"
                              v-slot="{ active, checked }">
                <div
                    :class="[active ? 'border-mostepe-green-light ring-2 ring-mostepe-green-light' : 'border-gray-300', 'object-center relative block cursor-pointer rounded-lg border bg-white px-6 py-4 shadow-sm focus:outline-none']">
                                          <span class="">
                                            <span class="flex flex-col text-sm text-center">
                                              <RadioGroupLabel as="span" class="font-medium text-gray-900 text-center items-center justify-center">{{ option.name }}</RadioGroupLabel>
                                            </span>
                                          </span>
                    <span
                        :class="[active ? 'border' : 'border-2', checked ? 'border-mostepe-green-light' : 'border-transparent', 'pointer-events-none absolute -inset-px rounded-lg']"
                        aria-hidden="true"/>
                </div>
            </RadioGroupOption>
        </div>
    </RadioGroup>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { RadioGroup, RadioGroupDescription, RadioGroupLabel, RadioGroupOption } from '@headlessui/vue'

const props = defineProps({
    modelValue: String,
    options: Object
})
const emit = defineEmits(['update:modelValue'])
const modelValue = ref(props.options[0].name)
</script>

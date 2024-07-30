<template>
    <ZacademiaAppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-green-50 size-full overflow-hidden shadow-xl sm:rounded-lg" :class="height">

                    <ApplicationProgressSteps :steps="steps"/>
                    <ApplicationProgressBar :progressPercent="progressPercent" class="m-3"/>

                    <slot />

                </div>
            </div>
        </div>
    </ZacademiaAppLayout>
</template>

<script setup>
import { ref } from 'vue'
import ZacademiaAppLayout from "@/Layouts/ZacademiaAppLayout.vue";
import ApplicationProgressBar from "@/Components/ApplicationProgressBar.vue";
import ApplicationProgressSteps from "@/Components/ApplicationProgressSteps.vue";

let props = defineProps({
    steps: Array,
    progressPercent: String,
    height: String
});

const plans = [
    { name: 'Primary School Scholar' },
    { name: 'High School Scholar' },
    { name: 'Undergraduate Student' },
    { name: 'Postgraduate Student' },
]

const mobileMenuOpen = ref(false)
</script>

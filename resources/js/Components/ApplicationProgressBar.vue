<template>
    <div>
        <div class="mt-6" aria-hidden="true">
            <div class="overflow-hidden rounded-full bg-gray-200">
                <div class="h-2 rounded-full bg-mostepe-green-dark" :style="progressPercent" />
            </div>
        </div>
    </div>
</template>

<script setup>

let props = defineProps({
    progressPercent:String
})
</script>

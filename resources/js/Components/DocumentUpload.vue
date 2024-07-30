<template>
    <InputLabel :value="label" />
    <div class="mt-1 flex justify-center rounded-lg border border-dashed border-gray-900/25 ">
        <div class="text-center">
            <!--                                        <PhotoIcon class="mx-auto h-12 w-12 text-gray-300" aria-hidden="true" />-->
            <div class="mt-4 flex text-sm leading-6 text-gray-600">
                <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-gray-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-mostepe-green-light focus-within:ring-offset-2 hover:text-mostepe-green-light">
                    <input
                        :ref="`${name}`"
                        @input="$emit('saveFile', file = $event.target.files[0])"
                        :id="`${props.name}`"
                        :name="props.name"
                        type="file"
                        placeholder=""
                    />
                </label>
            </div>
            <p class="text-xs leading-5 text-gray-600">PDF, PNG, JPG up to 1MB</p>
        </div>
    </div>
</template>

<script setup>

import InputLabel from "@/Components/InputLabel.vue";

let props = defineProps({
    label: String,
    name: String
});

let file = Object;

</script>

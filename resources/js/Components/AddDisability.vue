<template>
  <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Disability Name</label>
        <div class="mt-1">
            <TextInput
                v-model="appData.personal_information.parent_guardian_email"
                :id="props.name"
                :name="props.name"
                type="text"
                autocomplete="parent_guardian_email"
                placeholder="parent/guardian email"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
            />
            <InputError class="mt-2" :message="form.errors.parent_guardian_email"/>
        </div>

        <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900 mt-3">Attach proof of disability</label>
        <div class="mt-1 flex justify-center rounded-lg border border-dashed border-gray-900/25 ">
            <div class="text-center">
                <!--                                        <PhotoIcon class="mx-auto h-12 w-12 text-gray-300" aria-hidden="true" />-->
                <div class="mt-4 flex text-sm leading-6 text-gray-600">
                    <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-gray-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-mostepe-green-light focus-within:ring-offset-2 hover:text-mostepe-green-light">
                        <input
                            ref="id_copy"
                            @input="appData.personal_information.proof_of_address = $event.target.files[0]"
                            id="id_copy"
                            name="id_copy"
                            type="file"
                            placeholder=""
                        />
                    </label>
                </div>
                <p class="text-xs leading-5 text-gray-600">PDF, PNG, JPG up to 1MB</p>
            </div>
        </div>
    <InputError class="mt-2" :message="form.errors.parent_guardian_email"/>
</template>

<script setup>

import InputError from "@/Components/InputError.vue";
import SelectDropdown from "@/Components/SelectDropdown.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    // modelValue: String,
    name: String
})
const emit = defineEmits(['update:modelValue'])
// const modelValue = ref(props.options[0].name)

</script>

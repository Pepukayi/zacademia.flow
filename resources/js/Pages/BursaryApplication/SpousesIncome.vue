<template>
    <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900 mt-3">Annual income of your spouse</label>
    <div class="mt-1">
        <TextInput
            v-model="appData.personal_information.spouse_annual_income"
            id="spouse_annual_income"
            name="spouse_annual_income"
            type="text"
            autocomplete="spouse_annual_income"
            placeholder="Your spouses annual income"
            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
        />
        <InputError class="mt-2" :message="errors.spouse_annual_income"/>
    </div>

    <DocumentUpload :label="'Proof of income of your spouse'"
                    :name="'spouse_proof_of_income'"
                    @saveFile="(file) => appData.personal_information.spouse_proof_of_income = file"/>
    <InputError class="mt-2" :message="errors.spouse_proof_of_income"/>
</template>

<script setup>
import {ref} from 'vue'
import {Link, usePage, useForm} from '@inertiajs/vue3'
import {useDataStore} from "@/stores/DataStore";
import InputError from "@/Components/InputError.vue";
import DocumentUpload from "@/Components/DocumentUpload.vue";
import TextInput from "@/Components/TextInput.vue";

let appData = useDataStore();

const form = useForm({});

let props = defineProps({
    errors: Object
});
const mobileMenuOpen = ref(false)
</script>

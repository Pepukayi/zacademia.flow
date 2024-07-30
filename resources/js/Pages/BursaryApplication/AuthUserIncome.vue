<template>
    <InputLabel value="Your annual income"/>
    <div class="mt-1">
        <TextInput
            id="annual_income"
            v-model="appData.personal_information.annual_income"
            type="text"
            class="block w-full mt-1"
            autofocus
            autocomplete="annual_income"
            placeholder="Your annual income"
        />

        <InputError class="mt-2" :message="errors.annual_income"/>
    </div>

    <DocumentUpload :label="'Your proof of income'"
                    :name="'proof_of_income'"
                    @saveFile="(file) => appData.personal_information.proof_of_income = file"/>
    <InputError class="mt-2" :message="errors.proof_of_income"/>
</template>

<script setup>
import {ref} from 'vue'
import {Link, usePage, useForm} from '@inertiajs/vue3'
import {useDataStore} from "@/stores/DataStore";
import InputError from "@/Components/InputError.vue";
import DocumentUpload from "@/Components/DocumentUpload.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";

let appData = useDataStore();

const form = useForm({});

let props = defineProps({
    errors: Object
});
</script>

<template>
    <ApplicationAppLayout :steps="steps" :progressPercent="progressPercent" :height="'h-[650px]'">

                    <h3 class="mt-10 ml-4 text-lg text-center font-medium ">What is your identity number?</h3>

        <form @submit.prevent="submit">
                        <div class="m-6 justify-center items-center grid">

                            <div class="block mt-2 col-span-full w-96">
                                <InputLabel value="Identity Number" />
                                <div class="mt-2">
                                    <TextInput
                                        v-model="appData.personal_information.id_number"
                                        id="id_number"
                                        name="id_number"
                                        type="text"
                                        autocomplete="id_number"
                                        placeholder="ID Number"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
                                    />
                                    <InputError class="mt-2" :message="form.errors.id_number"/>
                                </div>
                            </div>

                            <div class="col-span-full mt-4">
                                <DocumentUpload :label="'ID/Passport Copy'"
                                                :name="'id_copy'"
                                                @saveFile="(file) => appData.personal_information.id_copy = file"/>
                                <InputError class="mt-2" :message="form.errors.id_copy"/>
                            </div>

                            <div class="col-span-full mt-6">
                                <DocumentUpload :label="'Back of ID Copy (if available)'"
                                                :name="'back_id_copy'"
                                                @saveFile="(file) => appData.personal_information.back_id_copy = file"/>
                                <InputError class="mt-2" :message="form.errors.back_id_copy"/>
                            </div>

                            </div>

                            <div class="m-6 flex justify-center space-x-16">
                                <NavLink href="#" @click="back" class="text-center w-40 rounded-md bg-mostepe-green-dark px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-mostepe-green-light focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-mostepe-green-dark">Back</NavLink>
                                <button type="submit" class="w-40 rounded-md bg-mostepe-green-dark px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-mostepe-green-light focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-mostepe-green-dark" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Continue</button>
                            </div>

        </form>
    </ApplicationAppLayout>
</template>

<script setup>
import { ref } from 'vue'
import { Link, usePage, useForm } from '@inertiajs/vue3'
import ApplicationAppLayout from "@/Layouts/ApplicationAppLayout.vue";
import {useDataStore} from "@/stores/DataStore";
import NavLink from "@/Shared/NavLink.vue";
import InputError from "@/Components/InputError.vue";
import DocumentUpload from "@/Components/DocumentUpload.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";

let appData = useDataStore();

const form = useForm({
});

let submit = () => {
    form.transform((data) => ({
        ...appData.getPersonalInformation,
    })).post(route('validateIdentityDocument'), {

    });
};

let back = function()
{
    window.history.back();
}

const steps = [
    {id: '01', name: 'Personal Information', href: '#', status: 'current'},
    {id: '02', name: 'School and Results', href: '#', status: 'upcoming'},
    { id: '03', name: 'Target Studies', href: '#', status: 'upcoming' },
    { id: '04', name: 'Agreements', href: '#', status: 'upcoming' },
]

const progressPercent = 'width: 10.9%';

const mobileMenuOpen = ref(false)
</script>

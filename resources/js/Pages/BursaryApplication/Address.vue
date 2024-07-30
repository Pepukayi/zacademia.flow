<template>
    <ApplicationAppLayout :steps="steps" :progressPercent="progressPercent" :height="'h-[900px]'">

        <h3 class="mt-5 ml-4 text-lg text-center font-medium ">What is your address?</h3>

        <form @submit.prevent="submit">
            <div class="m-2 grid justify-center items-center">

                <div class="block mt-5 col-span-full w-96">
                    <InputLabel value="Street address" />
                    <div class="mt-1">
                        <TextInput
                            v-model="appData.personal_information.street_address"
                            id="street_address"
                            name="street_address"
                            type="text"
                            autocomplete="street_address"
                            placeholder="street address"
                            class="w-full"
                        />
                        <InputError class="mt-2" :message="form.errors.street_address"/>
                    </div>
                </div>

                <div class="block mt-3 col-span-full w-96">
                    <InputLabel value="Suburb" />
                    <div class="mt-1">
                        <TextInput
                            v-model="appData.personal_information.suburb"
                            id="suburb"
                            name="suburb"
                            type="text"
                            autocomplete="suburb"
                            placeholder="Suburb"
                            class="w-full"
                        />
                        <InputError class="mt-2" :message="form.errors.suburb"/>
                    </div>
                </div>

                <div class="block mt-3 col-span-full w-96">
                    <InputLabel value="City" />
                    <div class="mt-1">
                        <TextInput
                            v-model="appData.personal_information.city"
                            id="city"
                            name="city"
                            type="text"
                            autocomplete="city"

                            placeholder="City"
                            class="w-full"
                        />
                        <InputError class="mt-2" :message="form.errors.city"/>
                    </div>
                </div>

                <div class="block mt-3 col-span-full w-96">
                    <InputLabel value="Province/State" />
                    <div class="mt-1">
                        <TextInput
                            v-model="appData.personal_information.province_state"
                            id="province_state"
                            name="province_state"
                            type="text"
                            autocomplete="province_state"

                            placeholder="Province/State"
                            class="w-full"
                        />
                        <InputError class="mt-2" :message="form.errors.province_state"/>
                    </div>
                </div>

                <div class="block mt-3 col-span-full w-96">
                    <InputLabel value="Postal/ZIP Code" />
                    <div class="mt-1">
                        <TextInput
                            v-model="appData.personal_information.postal_zip_code"
                            id="postal_zip_code"
                            name="postal_zip_code"
                            type="text"
                            autocomplete="postal_zip_code"
                            placeholder="Postal/ZIP Code"
                            class="w-full"
                        />
                        <InputError class="mt-2" :message="form.errors.postal_zip_code"/>
                    </div>
                </div>

                <div class="col-span-full mt-2">
                    <DocumentUpload :label="'Proof of Address'"
                                    :name="'proof_of_address'"
                                    @saveFile="(file) => appData.personal_information.proof_of_address = file"/>
                    <InputError class="mt-2" :message="form.errors.proof_of_address"/>
                </div>
            </div>

            <div class="m-6 flex justify-center space-x-16">
                <NavLink href="#" @click="back"
                         class="text-center w-40 rounded-md bg-mostepe-green-dark px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-mostepe-green-light focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-mostepe-green-dark">
                    Back
                </NavLink>
                <button type="submit"
                        class="w-40 rounded-md bg-mostepe-green-dark px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-mostepe-green-light focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-mostepe-green-dark"
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Continue
                </button>
            </div>
        </form>
    </ApplicationAppLayout>
</template>

<script setup>
import {ref} from 'vue'
import {Link, usePage, useForm} from '@inertiajs/vue3'
import {useDataStore} from "@/stores/DataStore";
import NavLink from "@/Shared/NavLink.vue";
import ApplicationAppLayout from "@/Layouts/ApplicationAppLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import DocumentUpload from "@/Components/DocumentUpload.vue";
import TextInput from "@/Components/TextInput.vue";

let appData = useDataStore();

const form = useForm({});

let submit = () => {
    form.transform((data) => ({
        ...data,
        ...appData.getPersonalInformation,
        ...appData.getVerificationDocuments,
    })).post(route('validateAddress'), {});
};

let back = function()
{
    window.history.back();
}

const steps = [
    {id: '01', name: 'Personal Information', href: '#', status: 'current'},
    {id: '02', name: 'School and Results', href: '#', status: 'upcoming'},
    {id: '03', name: 'Target Studies', href: '#', status: 'upcoming'},
    {id: '04', name: 'Agreements', href: '#', status: 'upcoming'},
]

const progressPercent = 'width: 20.9%';

const mobileMenuOpen = ref(false)
</script>

<template>
    <ApplicationAppLayout :steps="steps" :progressPercent="progressPercent" :height="'h-[650px]'">

        <h3 class="mt-10 ml-4 text-lg text-center font-medium ">NSFAS</h3>

        <form @submit.prevent="submit">
            <div class="m-6 grid justify-center items-center">

                <div class="block mt-2 col-span-full w-96">
                    <InputLabel value="Have you previously applied for NSFAS?" />
                    <div class="mt-2">
                        <SelectDropdown
                            class="w-96"
                            :options="nsfas_history"
                            :name="'nsfas_history'"
                            @update:modelValue="(value) => appData.personal_information.nsfas_history = value"/>
                        <InputError class="mt-2" :message="form.errors.nsfas_history"/>
                    </div>
                </div>

                <div v-if="appData.personal_information.nsfas_history === 'Yes'">
                    <div class="col-span-full mt-6">
                        <InputLabel value="Are you currently a NSFAS student?" />
                        <div class="mt-2">
                            <SelectDropdown
                                class="w-96"
                                :options="nsfas_history"
                                :name="'nsfas_student'"
                                @update:modelValue="(value) => appData.personal_information.nsfas_student = value"/>
                            <InputError class="mt-2" :message="form.errors.nsfas_student"/>
                        </div>
                    </div>

                    <div v-if="appData.personal_information.nsfas_student === 'Yes'">
                        <div class="mt-6">
                            <InputLabel value="NSFAS Registration Number" />
                            <TextInput
                                v-model="appData.personal_information.nsfas_registration_number"
                                id="nsfas_registration_number"
                                name="nsfas_registration_number"
                                type="text"
                                autocomplete="nsfas_registration_number"
                                placeholder="NSFAS registration number"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
                            />
                            <InputError class="mt-2" :message="form.errors.nsfas_registration_number"/>
                        </div>
                    </div>
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
import {RadioGroup, RadioGroupDescription, RadioGroupLabel, RadioGroupOption} from '@headlessui/vue'
import {useDataStore} from "@/stores/DataStore";
import NavLink from "@/Shared/NavLink.vue";
import ApplicationAppLayout from "@/Layouts/ApplicationAppLayout.vue";
import InputError from "@/Components/InputError.vue";
import SelectDropdown from "@/Components/SelectDropdown.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";

let appData = useDataStore();

const form = useForm({});

let submit = () => {
    form.transform((data) => ({
        ...appData.getPersonalInformation,
    })).post(route('validateNSFAS'), {});
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

const nsfas_history = [
    {name: 'Yes'},
    {name: 'No'},
]

const mobileMenuOpen = ref(false)
</script>

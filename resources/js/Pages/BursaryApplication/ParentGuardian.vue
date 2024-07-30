<template>
    <ApplicationAppLayout :steps="steps" :progressPercent="progressPercent" :height="'h-[900px]'">

        <h3 class="mt-5 ml-4 text-lg text-center font-medium ">Parent/Guardian Information</h3>

        <form @submit.prevent="submit">
            <div class="m-2 grid justify-center items-center">

                <div class="block mt-5 col-span-full w-96">
                    <InputLabel value="Do you live with your parent/guardian?" />
                    <div class="mt-1">
                        <SelectDropdown
                            class="w-96"
                            :options="stay_in"
                            :name="'stay_in'"
                            @update:modelValue="(value) => appData.personal_information.stay_in = value"/>
                        <InputError class="mt-2" :message="form.errors.stay_in"/>
                    </div>
                </div>

                    <div class="block mt-3 col-span-full w-96">
                        <InputLabel value="Parent/guardian email" />
                        <div class="mt-1">
                            <TextInput
                                v-model="appData.personal_information.parent_guardian_email"
                                id="parent_guardian_email"
                                name="parent_guardian_email"
                                type="text"
                                autocomplete="parent_guardian_email"
                                placeholder="parent/guardian email"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
                            />
                            <InputError class="mt-2" :message="form.errors.parent_guardian_email"/>
                        </div>
                    </div>

                    <div class="block mt-3 col-span-full w-96">
                        <InputLabel value="Parent/guardian contact number" />
                        <div class="mt-1">
                            <TextInput
                                v-model="appData.personal_information.parent_guardian_phone_number"
                                id="parent_guardian_phone_number"
                                name="parent_guardian_phone_number"
                                type="text"
                                autocomplete="parent_guardian_phone_number"
                                placeholder="parent/guardian phone number"
                                class="block w-full rounded-lg border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
                            />
                            <InputError class="mt-2" :message="form.errors.parent_guardian_phone_number"/>
                        </div>
                    </div>

                    <div class="block mt-3 col-span-full w-96">
                        <InputLabel value="Total dependents on your parent/guardian" />
                        <div class="mt-1">
                            <TextInput
                                v-model="appData.personal_information.dependents"
                                id="dependents"
                                name="dependents"
                                type="text"
                                autocomplete="dependents"
                                placeholder="Your parents/guardians dependants"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
                            />
                            <InputError class="mt-2" :message="form.errors.dependents"/>
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
import InputLabel from "@/Components/InputLabel.vue";
import SelectDropdown from "@/Components/SelectDropdown.vue";
import TextInput from "@/Components/TextInput.vue";

let appData = useDataStore();

const form = useForm({});

let submit = () => {
    form.transform((data) => ({
        ...data,
        ...appData.getPersonalInformation,
        ...appData.getVerificationDocuments,
    })).post(route('validateParentGuardian'), {});
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

const stay_in = [
    {name: 'Yes'},
    {name: 'No'},
]

const working_parents = [
    {name: 'None'},
    {name: 'One parent/guardian is working'},
    {name: 'Both parents/guardians are working'},
    {name: 'I am an orphan'},
]
const mobileMenuOpen = ref(false)
</script>

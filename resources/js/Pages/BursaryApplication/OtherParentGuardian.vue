<template>
    <ApplicationAppLayout :steps="steps" :progressPercent="progressPercent" :height="'h-[900px]'">

        <h3 class="mt-5 ml-4 text-lg text-center font-medium ">Other Parent/Guardian Information</h3>

        <form @submit.prevent="submit">
            <div class="m-2 grid justify-center items-center">
                <div class="block mt-3 col-span-full w-96">
                    <InputLabel value="Other Parent/Guardian Name" />
                    <div class="mt-1">
                        <TextInput
                            v-model="appData.personal_information.other_parent_guardian_name"
                            id="other_parent_guardian_name"
                            name="other_parent_guardian_name"
                            type="text"
                            autocomplete="other_parent_guardian_name"
                            placeholder="other parent/guardian name"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
                        />
                        <InputError class="mt-2" :message="form.errors.other_parent_guardian_name"/>
                    </div>
                </div>

                <div class="block mt-3 col-span-full w-96">
                    <InputLabel value="Other Parent/Guardian Surname" />
                    <div class="mt-1">
                        <TextInput
                            v-model="appData.personal_information.other_parent_guardian_surname"
                            id="other_parent_guardian_surname"
                            name="other_parent_guardian_surname"
                            type="text"
                            autocomplete="other_parent_guardian_surname"
                            placeholder="other parent/guardian surname"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
                        />
                        <InputError class="mt-2" :message="form.errors.other_parent_guardian_surname"/>
                    </div>
                </div>

                    <div class="block mt-3 col-span-full w-96">
                        <InputLabel value="Other Parent/Guardian Email" />
                        <div class="mt-1">
                            <TextInput
                                v-model="appData.personal_information.other_parent_guardian_email"
                                id="other_parent_guardian_email"
                                name="other_parent_guardian_email"
                                type="text"
                                autocomplete="other_parent_guardian_email"
                                placeholder="other parent/guardian email"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
                            />
                            <InputError class="mt-2" :message="form.errors.other_parent_guardian_email"/>
                        </div>
                    </div>

                    <div class="block mt-3 col-span-full w-96">
                        <InputLabel value="Other Parent/Guardian contact number" />
                        <div class="mt-1">
                            <TextInput
                                v-model="appData.personal_information.other_parent_guardian_phone_number"
                                id="other_parent_guardian_phone_number"
                                name="other_parent_guardian_phone_number"
                                type="text"
                                autocomplete="other_parent_guardian_phone_number"
                                placeholder="other parent/guardian phone number"
                                class="block w-full rounded-lg border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
                            />
                            <InputError class="mt-2" :message="form.errors.other_parent_guardian_phone_number"/>
                        </div>
                    </div>

                <div class="block mt-3 col-span-full w-96">
                    <div class="block mt-3 col-span-full w-96">
                        <DocumentUpload :label="'ID of your other parent'"
                                        :name="'other_parent_id'"
                                        @saveFile="(file) => appData.personal_information.other_parent_id = file"/>
                        <InputError class="mt-2" :message="form.errors.other_parent_id"/>
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
import DocumentUpload from "@/Components/DocumentUpload.vue";

let appData = useDataStore();

const form = useForm({});

let submit = () => {
    form.transform((data) => ({
        ...data,
        ...appData.getPersonalInformation,
    })).post(route('validateOtherParentGuardian'), {});
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

const working_parents = [
    {name: 'None'},
    {name: 'One parent/guardian is working'},
    {name: 'Both parents/guardians are working'},
    {name: 'I am an orphan'},
]
const mobileMenuOpen = ref(false)
</script>

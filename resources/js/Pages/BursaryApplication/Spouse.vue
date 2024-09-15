<template>
    <ApplicationAppLayout :steps="steps" :progressPercent="progressPercent" :height="'h-[1000px]'">

        <h3 class="mt-5 ml-4 text-lg text-center font-medium ">Spouse Information</h3>

        <form @submit.prevent="submit">
            <div class="m-2 grid justify-center items-center">

                <div class="block mt-5 col-span-full w-96">
                    <InputLabel value="Are you married?" />
                    <div class="mt-1">
                        <SelectDropdown
                            class="w-96"
                            :options="married"
                            :name="'marital_status'"
                            @update:modelValue="(value) => appData.personal_information.marital_status = value"/>
                        <InputError class="mt-2" :message="form.errors.marital_status"/>
                    </div>
                </div>


                <div v-if="appData.personal_information.marital_status === 'Yes'" class="col-span-full mt-3">
                    <div class="block mt-3 col-span-full w-96">
                        <InputLabel value="Spouse Name" />
                        <div class="mt-1">
                            <TextInput
                                v-model="appData.personal_information.spouse_name"
                                id="spouse_name"
                                name="spouse_name"
                                type="text"
                                autocomplete="spouse_name"
                                placeholder="spouses name"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
                            />
                            <InputError class="mt-2" :message="form.errors.spouse_name"/>
                        </div>
                    </div>

                    <div class="block mt-3 col-span-full w-96">
                        <InputLabel value="Spouse Surname" />
                        <div class="mt-1">
                            <TextInput
                                v-model="appData.personal_information.spouse_surname"
                                id="spouse_surname"
                                name="spouse_surname"
                                type="text"
                                autocomplete="spouse_surname"
                                placeholder="spouses surname"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
                            />
                            <InputError class="mt-2" :message="form.errors.spouse_surname"/>
                        </div>
                    </div>

                    <div class="block mt-3 col-span-full w-96">
                        <InputLabel value="Spouse Email" />
                        <div class="mt-1">
                            <TextInput
                                v-model="appData.personal_information.spouse_email"
                                id="spouse_email"
                                name="spouse_email"
                                type="text"
                                autocomplete="spouse_email"
                                placeholder="spouses email"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
                            />
                            <InputError class="mt-2" :message="form.errors.spouse_email"/>
                        </div>
                    </div>

                    <div class="block mt-3 col-span-full w-96">
                        <InputLabel value="Spouse contact number" />
                        <div class="mt-1">
                            <TextInput
                                v-model="appData.personal_information.spouse_contact"
                                id="spouse_contact"
                                name="spouse_contact"
                                type="text"
                                autocomplete="spouse_contact"

                                placeholder="spouses contact number"
                                class="block w-full rounded-lg border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
                            />
                            <InputError class="mt-2" :message="form.errors.spouse_contact"/>
                        </div>
                    </div>

                    <div class="block mt-3 col-span-full w-96">
                        <InputLabel value="Total dependents on you and your spouse" />
                        <div class="mt-1">
                            <TextInput
                                v-model="appData.personal_information.household_dependents"
                                id="household_dependents"
                                name="household_dependents"
                                type="text"
                                autocomplete="household_dependents"
                                placeholder="Your dependants"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
                            />
                            <InputError class="mt-2" :message="form.errors.household_dependents"/>
                        </div>
                    </div>

                    <div class="block mt-3 col-span-full w-96">
                        <DocumentUpload :label="'ID of your spouse'"
                                        :name="'spouse_id'"
                                        @saveFile="(file) => appData.personal_information.spouse_id = file"/>
                        <InputError class="mt-2" :message="form.errors.spouse_id"/>
                    </div>
                </div>

                <div v-if="['Divorced', 'No'].includes(appData.personal_information.marital_status)" class="col-span-full mt-3 w-96">
                    <InputLabel value="Are you still a dependent on your parents/guardians?" />
                    <HorizontalRadioGroup
                        :options="still_dependent"
                        :name="'still_dependent'"
                        @update:modelValue="(value) => appData.personal_information.parental_dependence = value"/>

                    <div v-if="appData.personal_information.parental_dependence === 'Yes'" class="block mt-3 col-span-full w-96">
                        <InputLabel value="How many parents/guardians do you still have?" />
                        <div class="mt-1">
                            <HorizontalRadioGroup
                                :options="number_parents"
                                :name="'number_parents_guardians'"
                                @update:modelValue="(value) => appData.personal_information.number_parents_guardians = value"/>
<!--                            <SelectDropdown-->
<!--                                class="w-96"-->
<!--                                :options="number_parents"-->
<!--                                :name="'number_parents_guardians'"-->
<!--                                @update:modelValue="(value) => appData.personal_information.number_parents_guardians = value"/>-->
                            <InputError class="mt-2" :message="form.errors.number_parents_guardians"/>
                        </div>

                        <InputLabel class="mt-3" value="Do you live with your parent/guardian?" />
                        <div class="mt-1">
                            <HorizontalRadioGroup
                                :options="stay_in"
                                :name="'stay_in'"
                                @update:modelValue="(value) => appData.personal_information.stay_in = value"/>
<!--                            <SelectDropdown-->
<!--                                class="w-96"-->
<!--                                :options="stay_in"-->
<!--                                :name="'stay_in'"-->
<!--                                @update:modelValue="(value) => appData.personal_information.stay_in = value"/>-->
                            <InputError class="mt-2" :message="form.errors.stay_in"/>
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
import {useDataStore} from "@/stores/DataStore";
import NavLink from "@/Shared/NavLink.vue";
import ApplicationAppLayout from "@/Layouts/ApplicationAppLayout.vue";
import InputError from "@/Components/InputError.vue";
import SelectDropdown from "@/Components/SelectDropdown.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import DocumentUpload from "@/Components/DocumentUpload.vue";
import HorizontalRadioGroup from "@/Components/HorizontalRadioGroup.vue";

let appData = useDataStore();

const form = useForm({});

let submit = () => {
    form.transform((data) => ({
        ...data,
        ...appData.getPersonalInformation,
    })).post(route('validateSpouseInformation'), {});
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

const married = [
    {name: 'Yes'},
    {name: 'No'},
    {name: 'Divorced'},
]

const still_dependent = [
    {name: 'Yes'},
    {name: 'No'},
]

const number_parents = [
    {name: 1},
    {name: 2},
]

const stay_in = [
    {name: 'Yes'},
    {name: 'No'},
]

const mobileMenuOpen = ref(false)
</script>

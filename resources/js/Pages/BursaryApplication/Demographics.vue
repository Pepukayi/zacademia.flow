<template>
    <ApplicationAppLayout :steps="steps" :progressPercent="progressPercent" :height="'h-[650px]'">

        <h3 class="mt-10 ml-4 text-lg text-center font-medium ">Gender and Ethnicity?</h3>

        <form @submit.prevent="submit">
            <div class="m-6 grid justify-center items-center">

                <div class="block mt-2 col-span-full w-96">
                    <label for="country" class="block text-sm font-medium leading-6 text-gray-900">What is your gender?</label>
                    <div class="mt-2">
                        <SelectDropdown
                            class="w-96"
                            :options="gender"
                            :name="'gender'"
                            @update:modelValue="(value) => appData.personal_information.gender = value"/>
                        <InputError class="mt-2" :message="form.errors.gender"/>
                    </div>
                </div>

                <div class="col-span-full mt-6">
                    <label for="country" class="block text-sm font-medium leading-6 text-gray-900">What is your ethnicity?</label>
                    <div class="mt-2">
                        <SelectDropdown
                            class="w-96"
                            :options="ethnicity"
                            :name="'ethnicity'"
                            @update:modelValue="(value) => appData.personal_information.ethnicity = value"/>
                        <InputError class="mt-2" :message="form.errors.ethnicity"/>
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
import SelectDropdown from "@/Components/SelectDropdown.vue";
import InputError from "@/Components/InputError.vue";

let appData = useDataStore();

const form = useForm({});

let submit = () => {
    form.transform((data) => ({
        ...data,
        ...appData.getPersonalInformation,
    })).post(route('validateDemographics'), {});
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

const gender = [
    {name: 'Male'},
    {name: 'Female'},
    {name: 'Other'},
]

const ethnicity = [
    {name: 'Black'},
    {name: 'Coloured'},
    {name: 'Indian'},
    {name: 'White'},
    {name: 'Other'},
]

const mobileMenuOpen = ref(false)
</script>

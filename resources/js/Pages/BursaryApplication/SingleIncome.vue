<template>
    <ApplicationAppLayout :steps="steps" :progressPercent="progressPercent" :height="'h-[650px]'">

        <h3 class="mt-5 ml-4 text-lg text-center font-medium ">Your Income</h3>

        <form @submit.prevent="submit">
            <div class="m-2 grid justify-center items-center">
                <div class="block mt-3 col-span-full w-96">
                    <InputLabel value="Are you working?" />
                    <div class="mt-1">
                        <SelectDropdown
                            class="w-96"
                            :options="employment_details"
                            :name="'employment_details'"
                            @update:modelValue="(value) => appData.personal_information.employment_details = value"/>
                        <InputError class="mt-2" :message="form.errors.employment_details"/>
                    </div>
                </div>

                <div v-if="appData.personal_information.employment_details === 'Yes'" class="col-span-full mt-3">
                    <AuthUserIncome :errors="form.errors"/>
                </div>

                <div v-if="appData.personal_information.employment_details === 'No'" class="col-span-full mt-3">
                    <DocumentUpload :label="'Affadavit that you are not working'"
                                    :name="'affadavit_not_working'"
                                    @saveFile="(file) => appData.personal_information.affadavit_not_working = file"/>
                    <InputError class="mt-2" :message="form.errors.affadavit_not_working"/>
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
import AuthUserIncome from "@/Pages/BursaryApplication/AuthUserIncome.vue";
import SpousesIncome from "@/Pages/BursaryApplication/SpousesIncome.vue";
import DocumentUpload from "@/Components/DocumentUpload.vue";
import SelectDropdown from "@/Components/SelectDropdown.vue";
import InputLabel from "@/Components/InputLabel.vue";

let appData = useDataStore();

const form = useForm({});

let submit = () => {
    form.transform((data) => ({
        ...data,
        ...appData.getPersonalInformation,
    })).post(route('validateSingleIncome'), {});
};

let back = function()
{
    window.history.back();
}

// let saveFile = function(file)
// {
//     appData.personal_information.affadavit_both_not_working = file;
// }

const steps = [
    {id: '01', name: 'Personal Information', href: '#', status: 'current'},
    {id: '02', name: 'School and Results', href: '#', status: 'upcoming'},
    {id: '03', name: 'Target Studies', href: '#', status: 'upcoming'},
    {id: '04', name: 'Agreements', href: '#', status: 'upcoming'},
]

const progressPercent = 'width: 20.9%';

const employment_details = [
    {name: 'Yes'},
    {name: 'No'},
]

const mobileMenuOpen = ref(false)
</script>

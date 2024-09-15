<template>
    <ApplicationAppLayout :steps="steps" :progressPercent="progressPercent" :height="'h-[900px]'">

        <h3 class="mt-5 ml-4 text-lg text-center font-medium ">Parent/Guardian Income</h3>

        <form @submit.prevent="submit">
            <div class="m-2 grid justify-center items-center">
                <div class="block mt-3 col-span-full">
                    <div class="block mt-3 mb-3 col-span-full w-96">
                        <InputLabel value="How many dependents do your parents/guardians have?" />
                        <div class="mt-1">
                            <TextInput
                                v-model="appData.personal_information.parents_dependents"
                                id="parents_dependents"
                                name="parents_dependents"
                                type="number"
                                autocomplete="parents_dependents"
                                placeholder="Your parents/guardians dependants"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
                            />
                            <InputError class="mt-2" :message="form.errors.parents_dependents"/>
                        </div>
                    </div>

                    <InputLabel value="How many of your parents/guardians are working" />
                    <div class="mt-1">
                        <SelectDropdown
                            class="w-96"
                            :options="working_parents"
                            :name="'number_working_parents_guardians'"
                            @update:modelValue="(value) => appData.personal_information.number_working_parents_guardians = value"/>
                        <InputError class="mt-2" :message="form.errors.number_working_parents_guardians"/>
                    </div>
                </div>

                <div v-if="appData.personal_information.number_working_parents_guardians === 'None'" class="col-span-full mt-3">
                    <DocumentUpload :label="'Affadavit that your parents/guardians do not work'"
                                    :name="'affadavit_parents_dont_work'"
                                    @saveFile="(file) => appData.personal_information.affadavit_parents_dont_work = file"/>
                    <InputError class="mt-2" :message="form.errors.affadavit_parents_dont_work"/>
                </div>

                <div v-if="appData.personal_information.number_working_parents_guardians === 'I am an orphan'" class="col-span-full mt-3">
                    <DocumentUpload :label="'Affadavit that you do not have a parent/guardian'"
                                    :name="'affadavit_orphan'"
                                    @saveFile="(file) => appData.personal_information.affadavit_orphan = file"/>
                    <InputError class="mt-2" :message="form.errors.affadavit_orphan"/>
                </div>

                <div v-if="appData.personal_information.number_working_parents_guardians === 'One parent/guardian is working'" class="col-span-full mt-3">
                    <InputLabel value="Annual income of your parent/guardian" />
                    <div class="mt-1 mb-3">
                        <TextInput
                            v-model="appData.personal_information.parent_annual_income"
                            id="parent_annual_income"
                            name="parent_annual_income"
                            type="number"
                            autocomplete="parent_annual_income"
                            placeholder="Your parents/guardians annual income"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
                        />
                        <InputError class="mt-2" :message="form.errors.parent_annual_income"/>
                    </div>

                    <DocumentUpload :label="'Proof of income of your parent/guardian'"
                                    :name="'parent_proof_of_income'"
                                    @saveFile="(file) => appData.personal_information.parent_proof_of_income = file"/>
                    <InputError class="mt-2" :message="form.errors.parent_proof_of_income"/>

                    <div class="mt-3" v-if="appData.personal_information.number_parents_guardians === 2">
                        <DocumentUpload :label="'Affadavit that your other parent/guardian doesnt work'"
                                        :name="'affadavit_other_parent_doesnt_work'"
                                        @saveFile="(file) => appData.personal_information.affadavit_other_parent_doesnt_work = file"/>
                        <InputError class="mt-2" :message="form.errors.affadavit_other_parent_doesnt_work"/>
                    </div>
                </div>

                <div v-if="appData.personal_information.number_working_parents_guardians === 'Both parents/guardians are working'" class="col-span-full mt-3">
                    <InputLabel value="Annual income of your parent/guardian" />
                    <div class="mt-1 w-96">
                        <TextInput
                            v-model="appData.personal_information.parent_annual_income"
                            id="parent_annual_income"
                            name="parent_annual_income"
                            type="number"
                            autocomplete="parent_annual_income"
                            placeholder="Your parents/guardians annual income"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
                        />
                    </div>
                    <InputError class="mt-2" :message="form.errors.parent_annual_income"/>

                    <div class="mt-1 w-96">
                        <DocumentUpload class=" w-96" :label="'Proof of income of your parent/guardian'"
                                    :name="'parent_proof_of_income'"
                                    @saveFile="(file) => appData.personal_information.parent_proof_of_income = file"/>
                    </div>
                    <InputError class="mt-2" :message="form.errors.parent_proof_of_income"/>

                    <InputLabel value="Annual income of your other parent/guardian" />
                    <div class="mt-1 w-96">
                        <TextInput
                            v-model="appData.personal_information.other_parent_annual_income"
                            id="other_parent_annual_income"
                            name="other_parent_annual_income"
                            type="number"
                            autocomplete="other_parent_annual_income"
                            placeholder="Your other parents/guardians annual income"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
                        />
                        <InputError class="mt-2" :message="form.errors.other_parent_annual_income"/>
                    </div>

                    <div class="mt-1 w-96">
                        <DocumentUpload :label="'Proof of income of your other parent/guardian'"
                                        :name="'other_parent_proof_of_income'"
                                        @saveFile="(file) => appData.personal_information.other_parent_proof_of_income = file"/>
                    </div>
                    <InputError class="mt-2" :message="form.errors.other_parent_proof_of_income"/>
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
import countries from "@/countries.json";
import SelectDropdown from "@/Components/SelectDropdown.vue";
import DocumentUpload from "@/Components/DocumentUpload.vue";
import TextInput from "@/Components/TextInput.vue";

let appData = useDataStore();

const form = useForm({});

let submit = () => {
    form.transform((data) => ({
        ...data,
        ...appData.getPersonalInformation,
    })).post(route('validateParentGuardianIncome'), {});
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

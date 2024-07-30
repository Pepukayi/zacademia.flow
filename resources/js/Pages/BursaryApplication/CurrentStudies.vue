<template>
    <ApplicationAppLayout :steps="steps" :progressPercent="progressPercent" :height="'h-[650px]'">

        <h3 class="mt-10 ml-4 text-lg text-center font-medium ">About Current Studies</h3>

        <form @submit.prevent="submit">
            <div class="m-6 grid justify-center items-center">

                <div class="block mt-2 col-span-full w-96">
                    <InputLabel value="Which high school did you attend?" />
                    <div class="mt-1">
                        <TextInput
                            v-model="appData.personal_information.high_school"
                            id="high_school"
                            name="high_school"
                            type="text"
                            autocomplete="high_school"
                            placeholder=""
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
                        />
                        <InputError class="mt-2" :message="form.errors.high_school"/>
                    </div>
                </div>

                <div class="block mt-2 col-span-full w-96">
                    <InputLabel value="Your highest level completed?" />
                    <div class="mt-2">
                        <SelectDropdown
                            class="w-96"
                            :options="high_school_levels"
                            :name="'high_school_level'"
                            @update:modelValue="(value) => appData.personal_information.high_school_level = value"/>
                        <InputError class="mt-2" :message="form.errors.high_school_level"/>
                    </div>
                </div>

                <div>
                    <div class="col-span-full mt-6">
                        <InputLabel value="Which curriculum did you follow?" />
                        <div class="mt-2">
                            <SelectDropdown
                                class="w-96"
                                :options="curriculums"
                                :name="'curriculum'"
                                @update:modelValue="(value) => appData.personal_information.curriculum = value"/>
                            <InputError class="mt-2" :message="form.errors.curriculum"/>
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
    {id: '01', name: 'Personal Information', href: '#', status: 'complete'},
    {id: '02', name: 'School and Results', href: '#', status: 'current'},
    {id: '03', name: 'Target Studies', href: '#', status: 'upcoming'},
    {id: '04', name: 'Agreements', href: '#', status: 'upcoming'},
]

const progressPercent = 'width: 20.9%';

const high_school_levels = [
    {name: 7},
    {name: 9},
    {name: 10},
    {name: 11},
    {name: 12},
]

const curriculums = [
    {name: 'NSC'},
    {name: 'Cambridge'},
    {name: 'Zimsec'},
]

const mobileMenuOpen = ref(false)
</script>

<template>
    <ApplicationAppLayout :steps="steps" :progressPercent="progressPercent" :height="'h-[650px]'">
        <h3 class="mt-10 ml-4 text-lg text-center font-medium ">What level of studies are you currently</h3>

        <form @submit.prevent="submit">
            <div class="m-6 grid justify-center items-center">
            <div class="col-span-full mt-6">
                <StakedRadioGroup :options="currentLevels" @update:modelValue="(value) => appData.personal_information.current_level = value"/>
                <InputError class="mt-2" :message="form.errors.current_level"/>
            </div>
            </div>

            <div class="m-6 flex justify-center items-center">
                <button type="submit" class="w-60 rounded-md bg-mostepe-green-dark px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-mostepe-green-light focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-mostepe-green" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Continue</button>
            </div>
        </form>
    </ApplicationAppLayout>
</template>

<script setup>
import { ref } from 'vue'
import { Link, usePage, useForm } from '@inertiajs/vue3'
import {useDataStore} from "@/stores/DataStore";
import ApplicationAppLayout from "@/Layouts/ApplicationAppLayout.vue";
import StakedRadioGroup from "@/Components/StakedRadioGroup.vue";
import InputError from "@/Components/InputError.vue";

let appData = useDataStore();

const form = useForm({
});

let submit = () => {
    form.transform((data) => ({
        ...data,
        ...appData.getPersonalInformation,
    })).post(route('validateCurrentLevel'), {
    });
};

const steps = [
    {id: '01', name: 'Personal Information', href: '#', status: 'current'},
    {id: '02', name: 'School and Results', href: '#', status: 'upcoming'},
    { id: '03', name: 'Target Studies', href: '#', status: 'upcoming' },
    { id: '04', name: 'Agreements', href: '#', status: 'upcoming' },
]

const progressPercent = 'width: 10.9%';

const currentLevels = [
    { name: 'Primary School Scholar' },
    { name: 'High School Scholar' },
    { name: 'Undergraduate Student' },
    { name: 'Postgraduate Student' },
]

// const selected = ref(plans[0])
appData.personal_information.current_level = ref(currentLevels[0].name)

const mobileMenuOpen = ref(false)
</script>

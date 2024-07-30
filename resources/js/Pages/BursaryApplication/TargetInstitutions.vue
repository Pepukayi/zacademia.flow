<template>
    <ApplicationAppLayout :steps="steps" :progressPercent="progressPercent" :height="'h-[950px]'">
        <h3 class="mt-10 ml-4 text-lg text-center font-medium ">What type of institution do want to apply to?</h3>

        <form @submit.prevent="submit">
            <div class="m-6 grid justify-center items-center">
                <StakedRadioGroup :options="institution_type"
                                  @update:modelValue="(value) => appData.target_studies.institution_type = value"/>
                <InputError class="mt-2" :message="form.errors.institution_type"/>

                <div v-if="appData.target_studies.institution_type === 'Other'" class="block mt-6 col-span-full w-96">
                    <InputLabel value="Specify another type of institution" />
                    <TextInput
                        v-model="appData.target_studies.other_institution_type"
                        id="other_institution_type"
                        name="other_institution_type"
                        type="text"
                        autocomplete="on"
                        placeholder="other institution type"
                        class="w-full mt-3"
                    />
                    <InputError class="mt-2" :message="form.errors.high_school_graduation_year"/>
                </div>
            </div>
            <div class="m-6 flex justify-center space-x-16">
                <NavLink href="#" @click="back" class="text-center w-40 rounded-md bg-mostepe-green-dark px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-mostepe-green-light focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-mostepe-green-dark">Back</NavLink>
                <button type="submit" class="w-40 rounded-md bg-mostepe-green-dark px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-mostepe-green-light focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-mostepe-green-dark" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Continue</button>
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
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import NavLink from "@/Shared/NavLink.vue";

let appData = useDataStore();

const form = useForm({
});

let submit = () => {
    form.transform((data) => ({
        ...data,
        ...appData.getTargetInstitutionInformation,
    })).post(route('validateTargetInstitution'), {
    });
};

const steps = [
    {id: '01', name: 'Personal Information', href: '#', status: 'complete'},
    {id: '02', name: 'School and Results', href: '#', status: 'complete'},
    { id: '03', name: 'Target Studies', href: '#', status: 'current' },
    { id: '04', name: 'Background Information', href: '#', status: 'upcoming' },
]

const progressPercent = 'width: 10.9%';

const institution_type = [
    { name: 'University' },
    { name: 'University of Technology' },
    { name: 'TVET College' },
    { name: 'Agricultural College' },
    { name: 'Accredited Pvt HE College' },
    { name: 'Other' },
]

// const selected = ref(plans[0])
appData.personal_information.current_level = ref(institution_type[0].name)

const mobileMenuOpen = ref(false)
</script>

<template>
    <ApplicationAppLayout :steps="steps" :progressPercent="progressPercent" :height="'h-[650px]'">

                    <h3 class="mt-10 ml-4 text-lg text-center font-medium ">What is your birthday?</h3>

        <form @submit.prevent="submit">
                        <div class="m-6 flex justify-center items-center grid">

                            <div class="col-span-4 w-96">
                                <InputLabel value="Date Of Birth" />
                                <div class="mt-2">
                                    <vue-tailwind-datepicker :formatter="formatter" as-single v-model="appData.personal_information.date_of_birth" />
                                    <InputError class="mt-2" :message="form.errors.date_of_birth"/>
                                </div>
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
import VueTailwindDatepicker from 'vue-tailwind-datepicker';
import {useDataStore} from "@/stores/DataStore";
import NavLink from "@/Shared/NavLink.vue";
import ApplicationAppLayout from "@/Layouts/ApplicationAppLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";

let appData = useDataStore();

const form = useForm({
});

let submit = () => {
    form.transform((data) => ({
        ...data,
        ...appData.getPersonalInformation,
    })).post(route('validateBirthDay'), {
    });
};

let back = function()
{
    window.history.back();
}

const steps = [
    {id: '01', name: 'Personal Information', href: '#', status: 'current'},
    {id: '02', name: 'School and Results', href: '#', status: 'upcoming'},
    { id: '03', name: 'Target Studies', href: '#', status: 'upcoming' },
    { id: '04', name: 'Agreements', href: '#', status: 'upcoming' },
]

const progressPercent = 'width: 10.9%';

const plans = [
    { name: 'High School Scholar' },
    { name: 'Undergraduate Student' },
    { name: 'Postgraduate Student' },
]

const formatter = ref({
    date: 'YYYY-MM-DD',
    month: 'MMM'
})

const mobileMenuOpen = ref(false)

</script>

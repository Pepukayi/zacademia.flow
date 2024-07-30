<template>
    <ApplicationAppLayout :steps="steps" :progressPercent="progressPercent" :height="'h-[950px]'">

        <h3 class="mt-10 ml-4 text-lg text-center font-medium ">About Your Background</h3>

        <form @submit.prevent="submit">
            <div class="m-6 justify-center items-center grid">
                <div class="block mt-3 col-span-full w-96">
                    <InputLabel value="Please describe your personal background and family circumstances?" />
                    <div class="mt-1">
                        <TextAreaInput
                            :rows="5"
                            v-model="appData.background_information.background_circumstances"
                            id="background_circumstances"
                            name="background_circumstances"
                            autocomplete="Yes"
                            placeholder="Enter your personal background"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
                        />
                        <InputError class="mt-2" :message="form.errors.background_circumstances"/>
                    </div>
                </div>

                <div class="block mt-3 col-span-full w-96">
                    <InputLabel value="Describe (or list) your achievements to date (academic, sport, community service, etc)?" />
                    <div class="mt-1">
                        <TextAreaInput
                            :rows="5"
                            v-model="appData.background_information.achievements"
                            id="achievements"
                            name="achievements"
                            autocomplete="Yes"
                            placeholder="Enter your achievements"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
                        />
                        <InputError class="mt-2" :message="form.errors.achievements"/>
                    </div>
                </div>

                <div class="block mt-3 col-span-full w-96">
                    <InputLabel value="What leadership positions have you served in and what impact have you had as a leader?" />
                    <div class="mt-1">
                        <TextAreaInput
                            :rows="5"
                            v-model="appData.background_information.leadership_roles"
                            id="leadership_roles"
                            name="leadership_roles"
                            autocomplete="Yes"
                            placeholder="Enter your leadership roles"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-mostepe-green-light sm:text-sm sm:leading-6"
                        />
                        <InputError class="mt-2" :message="form.errors.leadership_roles"/>
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
import TextAreaInput from "@/Components/TextAreaInput.vue";

let appData = useDataStore();

const form = useForm({});

let submit = () => {
    form.transform((data) => ({
        ...appData.getBackgroundInformation,
    })).post(route('validateBackgroundInformation'), {});
};

let back = function()
{
    window.history.back();
}

const steps = [
    {id: '01', name: 'Personal Information', href: '#', status: 'complete'},
    {id: '02', name: 'School and Results', href: '#', status: 'complete'},
    { id: '03', name: 'Target Studies', href: '#', status: 'current' },
    { id: '04', name: 'Background Information', href: '#', status: 'upcoming' },
]

const progressPercent = 'width: 20.9%';

const sa_universities = [
    {name: 'Nelson Mandela Metropolitan University'},
    {name: 'North-West University'},
    {name: 'Rhodes University'},
    {name: 'Sefako Makgatho Health Sciences University'},
    {name: 'Sol Plaatje University'},
    {name: 'Stellenbosch University'},
    {name: 'University of Cape Town'},
    {name: 'University of Fort Hare'},
    {name: 'University of Johannesburg'},
    {name: 'University of KwaZulu-Natal'},
    {name: 'University of Limpopo'},
    {name: 'University of Mpumalanga'},
    {name: 'University of Pretoria'},
    {name: 'University of South Africa (UNISA)'},
    {name: 'University of the Free State'},
    {name: 'University of the Western Cape'},
    {name: 'University of the Witwatersrand'},
    {name: 'University of Venda'},
    {name: 'University of Zululand'},
]

const sa_universities_of_technology = [
    {name: 'Cape Peninsula University of Technology'},
    {name: 'Central University of Technology'},
    {name: 'Durban University of Technology'},
    {name: 'Mangosuthu University of Technology'},
    {name: 'Tshwane University of Technology'},
    {name: 'Tshwane University of Technology'},
    {name: 'Vaal University of Technology'},
    {name: 'Walter Sisulu University of Technology and Science'},
]

const sa_tvet_colleges = [
    {name: 'Boland TVET College'},
    {name: 'Buffalo City TVET College'},
    {name: 'Capricorn TVET College'},
    {name: 'Central Johannesburg TVET College'},
    {name: 'Coastal TVET College'},
    {name: 'College of Cape Town for TVET'},
    {name: 'Eastcape Midlands TVET College'},
    {name: 'Ehlanzeni TVET College'},
    {name: 'Ekurhuleni East TVET College'},
    {name: 'Ekurhuleni West TVET College'},
    {name: 'Elangeni TVET College'},
    {name: 'Esayidi TVET College'},
    {name: 'False Bay TVET College'},
    {name: 'Flavius Mareka TVET College'},
    {name: 'Gert Sibande TVET College'},
    {name: 'Goldfields TVET College'},
    {name: 'Ikhala TVET College'},
    {name: 'Ingwe TVET College'},
    {name: 'King Hintsa TVET College'},
    {name: 'King Sabata Dalindyebo TVET College'},
    {name: 'Lephalale TVET College'},
    {name: 'Letaba TVET College'},
    {name: 'Lovedale TVET College'},
    {name: 'Majuba TVET College'},
    {name: 'Maluti TVET College'},
    {name: 'Mnambithi TVET College'},
    {name: 'Mopani South TVET College'},
    {name: 'Motheo TVET College'},
    {name: 'Mthashana TVET College'},
    {name: 'Nkangala TVET College'},
    {name: 'Northern Cape Rural TVET College'},
    {name: 'Northern Cape Urban TVET College'},
    {name: 'Northlink TVET College'},
    {name: 'Orbit TVET College'},
    {name: 'Port Elizabeth TVET College'},
    {name: 'Sedibeng TVET College'},
    {name: 'Sekhukhune TVET College'},
    {name: 'South Cape TVET College'},
    {name: 'South West Gauteng TVET College'},
    {name: 'Taletso TVET College'},
    {name: 'Thekwini TVET College'},
    {name: 'Tshwane North TVET College'},
    {name: 'Tshwane South TVET College'},
    {name: 'Umfolozi TVET College'},
    {name: 'Umgungundlovu TVET College'},
    {name: 'Vhembe TVET College'},
    {name: 'Vuselela TVET College'},
    {name: 'Waterberg TVET College'},
    {name: 'West Coast TVET College'},
    {name: 'Western College for TVET'},
]

const mobileMenuOpen = ref(false)
</script>

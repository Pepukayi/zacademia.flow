<template>
    <form @submit.prevent="submit">
        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12">
            <div class="sm:col-span-6">
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                <div class="mt-2">
                    <input
                        v-model="appData.registration_information.first_name"
                        id="name"
                        name="name"
                        type="text"
                        autocomplete="name"
                        required=""
                        placeholder="Name"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    />
                    <InputError class="mt-2" :message="form.errors.first_name"/>
                </div>
            </div>

            <div class="sm:col-span-6">
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Surname</label>
                <div class="mt-2">
                    <input
                        v-model="appData.registration_information.last_name"
                        id="surname"
                        name="surname"
                        type="text"
                        autocomplete="surname"
                        required=""
                        placeholder="Surname"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    />
                    <InputError class="mt-2" :message="form.errors.last_name"/>
                </div>
            </div>

            <div class="block mt-2 col-span-7">
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                <div class="mt-2">
                    <input
                        v-model="appData.registration_information.email"
                        id="email"
                        name="email"
                        type="email"
                        autocomplete="username"
                        required=""
                        placeholder="you@example.com"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    />
                    <InputError class="mt-2" :message="form.errors.email"/>
                </div>
            </div>

            <div class="block mt-2 col-span-5">
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Phone Number</label>
                <div class="mt-2">
                    <input
                        v-model="appData.registration_information.phone_number"
                        id="phone_number"
                        name="phone_number"
                        type="text"
                        autocomplete="phone_number"
                        required=""
                        placeholder="+27 31 234 8000"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    />
                    <InputError class="mt-2" :message="form.errors.surname"/>
                </div>
            </div>

            <div class="col-span-12">
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                <div class="mt-2">
                    <input
                        v-model="appData.registration_information.password"
                        type="password"
                        name="password"
                        id="password"
                        autocomplete="new-password"
                        placeholder="password"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    />
                    <div v-if="form.errors.password" v-text="form.errors.password"
                         class="text-red-500 text-xs mt-1"></div>
                </div>
            </div>

            <div class="col-span-12">
                <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Confirm
                                                                                                             Password</label>
                <div class="mt-2">
                    <input
                        v-model="appData.registration_information.password_confirmation"
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        autocomplete="new-password"
                        placeholder="confirm password"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    />
                    <div v-if="form.errors.password_confirmation" v-text="form.errors.password_confirmation"
                         class="text-red-500 text-xs mt-1"></div>
                </div>
            </div>

            <div class="col-span-12">
                <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="text-sm leading-6 mt-1 flex items-center">
                    <input
                        v-model="appData.registration_information.terms_conditions"
                        id="terms_conditions"
                        name="terms_conditions"
                        type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"
                    />
                    <p class="text-gray-500 ml-1">I hereby agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-mostepe-green-dark hover:text-mostepe-green-light rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mostepe-green-light">Terms and Conditions</a></p>
                    <!--                    <p class="text-gray-500">I hereby agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Privacy Policy</a> of the Colmin Group operations.</p>-->
                </div>
            </div>

            <div class="col-span-12">
                <button type="submit"
                        class="flex w-full justify-center rounded-md bg-mostepe-green-dark px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-mostepe-green-light focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-mostepe-green"
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Register
                </button>
            </div>
        </div>
    </form>
</template>

<script setup>
import { ref } from 'vue'
import { Head, Link, useForm } from '@inertiajs/vue3';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import { Dialog, DialogPanel } from '@headlessui/vue'
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline'
import {useDataStore} from "@/stores/DataStore";

let appData = useDataStore();

const navigation = [
    // { name: 'Product', href: '#' },
    // { name: 'Features', href: '#' },
    // { name: 'Marketplace', href: '#' },
    // { name: 'Company', href: '#' },
    { name: 'Log in', href: '#' },
]

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    // email: '',
    // password: '',
    // remember: false,
    // name: '',
    // surname: '',
    // phone_number: '',
});

let submit = () => {
    // console.log("First Name: " . formData.getPersonalInformation)
    form.transform((data) => ({
        ...appData.getRegistrationInformation,

    })).post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

const mobileMenuOpen = ref(false)
</script>

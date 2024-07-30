<template>
    <div class="bg-white">
        <div class="relative">
            <div class="mx-auto max-w-7xl">
                <div class="relative z-10 pt-14 lg:w-full lg:max-w-2xl">
                    <svg class="absolute inset-y-0 right-8 hidden h-full w-80 translate-x-1/2 transform fill-white lg:block" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                        <polygon points="0,0 90,0 50,100 0,100" />
                    </svg>

                    <div class="relative px-6 py-32 sm:py-40 lg:px-8 lg:py-56 lg:pr-0">
                        <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-xl">
                            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Zacademia.Flow</h1>
                            <div v-if="appData.sign_up === false" class="mt-10  sm:w-full sm:max-w-sm">
                                <SignIn />

                                <p class="mt-10 text-center text-sm text-gray-500">
                                    Not a member?
                                    {{ ' ' }}
                                    <Link href="/register" class="font-semibold leading-6 text-mostepe-green-dark hover:text-mostepe-green-light" @click="appData.sign_up = true">Sign Up</Link>
                                </p>
                            </div>
                            <div v-if="appData.sign_up" class="mt-10  sm:w-full sm:max-w-sm">
                                <SignUp />

                                <p class="mt-10 text-center text-sm text-gray-500">
                                    Already a member?
                                    {{ ' ' }}
                                    <Link href="/register" class="font-semibold leading-6 text-mostepe-green-dark hover:text-mostepe-green-light" @click="appData.sign_up = false">Sign In</Link>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
                <img class="aspect-[3/2] object-cover lg:aspect-auto lg:h-full lg:w-full" src="/img/students-graduation.jpg" alt="" />
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { Head, Link, useForm } from '@inertiajs/vue3';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import { Dialog, DialogPanel } from '@headlessui/vue'
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline'
import SignIn from "@/Pages/Auth/SignIn.vue";
import SignUp from "@/Pages/Auth/SignUp.vue";
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

// const signIn = computed(() => {
//
//     return feeAmount;
// })

// const sign_in = ref(null);
// let sign_up = true;

// function signUp()
// {
//     sign_up = true;
//     sign_in = false;
// }
//
// function signIn()
// {
//     sign_up = false;
//     sign_in = true;
// }

const form = useForm({
    email: '',
    password: '',
    remember: false,
    name: '',
    surname: '',
    phone_number: '',
});

const mobileMenuOpen = ref(false)
</script>

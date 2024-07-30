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
                            <!--                            <div class="hidden sm:mb-10 sm:flex">-->
                            <!--                                <div class="relative rounded-full px-3 py-1 text-sm leading-6 text-gray-500 ring-1 ring-gray-900/10 hover:ring-gray-900/20">-->
                            <!--                                    Back to main website. <a href="https://www.motsepefoundation.org/education-and-leadership-2/bursary-programme/" target="_blank" class="whitespace-nowrap font-semibold text-mostepe-green-dark"><span class="absolute inset-0" aria-hidden="true" />Read more <span aria-hidden="true">&rarr;</span></a>-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Zacademia.Flow</h1>
                            <p class="mt-6 text-lg leading-8 text-gray-600">Apply to a variety of bursaries.</p>
                            <p class="mt-6 text-lg leading-8 text-gray-600">Applications for the 2024 Bursary Programme are now open. The deadline for the 2024 applications is 15 January 2024.</p>
                            <div class="mt-10 flex items-center gap-x-6">
                                <!--                                <a href="#" class="rounded-md bg-mostepe-green-dark px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-mostepe-yellow-light focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-mostepe-green">Apply Now</a>-->
                                <a href="/register" class="rounded-md bg-mostepe-green-dark px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-mostepe-green-light focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-mostepe-green">Apply Now</a>
                                <!--                                <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Learn more <span aria-hidden="true">→</span></a>-->
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
import { Dialog, DialogPanel } from '@headlessui/vue'
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline'

const navigation = [
    // { name: 'Product', href: '#' },
    // { name: 'Features', href: '#' },
    // { name: 'Marketplace', href: '#' },
    // { name: 'Company', href: '#' },
    { name: 'Log in', href: '#' },
]

const mobileMenuOpen = ref(false)
</script>

<template>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 m-5">
        <div v-for="(action, actionIdx) in actions" :key="action.email" :class="[action.iconBackground ?? 'bg-white']" class="relative flex items-center space-x-3 rounded-lg border border-gray-300 px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
<!--            <div class="flex-shrink-0">-->
<!--                <img class="h-10 w-10 rounded-full" :src="person.imageUrl" alt="" />-->
<!--            </div>-->
            <div class="min-w-0 flex-1">
                <Link :href="action.href" class="focus:outline-none">
                    <span class="absolute inset-0" aria-hidden="true" />
                    <h3 class="text-base font-semibold leading-6 text-gray-900">{{ action.title }}</h3>
                    <p class="mt-2 text-sm text-gray-500">{{ action.description }}</p>
                </Link>
            </div>
        </div>
    </div>

<!-- Second Landing Actions design -->
    <!--    <div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-gray-200 shadow sm:grid sm:grid-cols-2 sm:gap-px sm:divide-y-0">-->
<!--        <div v-for="(action, actionIdx) in actions" :key="action.title" :class="[actionIdx === 0 ? 'rounded-tl-lg rounded-tr-lg sm:rounded-tr-none' : '', actionIdx === 1 ? 'sm:rounded-tr-lg' : '', actionIdx === actions.length - 2 ? 'sm:rounded-bl-lg' : '', actionIdx === actions.length - 1 ? 'rounded-bl-lg rounded-br-lg sm:rounded-bl-none' : '', 'group relative bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500']">-->
<!--            <div>-->
<!--&lt;!&ndash;        <span :class="[action.iconBackground, action.iconForeground, 'inline-flex rounded-lg p-3 ring-4 ring-white']">&ndash;&gt;-->
<!--&lt;!&ndash;          <component :is="action.icon" class="h-6 w-6" aria-hidden="true" />&ndash;&gt;-->
<!--&lt;!&ndash;        </span>&ndash;&gt;-->
<!--            </div>-->
<!--            <div class="mt-5">-->
<!--                <h3 class="text-base font-semibold leading-6 text-gray-900">-->
<!--                    <a :href="action.href" class="focus:outline-none">-->
<!--                        &lt;!&ndash; Extend touch target to entire panel &ndash;&gt;-->
<!--                        <span class="absolute inset-0" aria-hidden="true" />-->
<!--                        {{ action.title }}-->
<!--                    </a>-->
<!--                </h3>-->
<!--                <p class="mt-2 text-sm text-gray-500">{{ action.description }}</p>-->
<!--            </div>-->
<!--            <span class="pointer-events-none absolute right-6 top-6 text-gray-300 group-hover:text-gray-400" aria-hidden="true">-->
<!--        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">-->
<!--          <path d="M20 4h1a1 1 0 00-1-1v1zm-1 12a1 1 0 102 0h-2zM8 3a1 1 0 000 2V3zM3.293 19.293a1 1 0 101.414 1.414l-1.414-1.414zM19 4v12h2V4h-2zm1-1H8v2h12V3zm-.707.293l-16 16 1.414 1.414 16-16-1.414-1.414z" />-->
<!--        </svg>-->
<!--      </span>-->
<!--        </div>-->
<!--    </div>-->
</template>

<script setup>
import { ref } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
import { Dialog, DialogPanel } from '@headlessui/vue'

import {
    Bars3Icon,
    XMarkIcon,
    AcademicCapIcon,
    BanknotesIcon,
    CheckBadgeIcon,
    ClockIcon,
    ReceiptRefundIcon,
    UsersIcon,
} from '@heroicons/vue/24/outline'

const navigation = [
    // { name: 'Product', href: '#' },
    // { name: 'Features', href: '#' },
    // { name: 'Marketplace', href: '#' },
    // { name: 'Company', href: '#' },
    { name: 'Log in', href: '#' },
]

const actions = [
    {
        title: "Hi, " + usePage().props.auth.user.username,
        href: '#',
        description: 'Done',
        icon: ClockIcon,
        iconForeground: 'text-teal-700',
        iconBackground: 'bg-teal-50',
    },
    {
        title: 'Application Status',
        href: '/profile-current-level',
        description: 'Your Application is currently ' + usePage().props.auth.user.current_application_status,
        icon: CheckBadgeIcon,
        iconForeground: 'text-purple-700',
        iconBackground: 'bg-purple-50',
    },
    {
        title: 'Bursary Invitation',
        href: '#',
        description: 'If you have been invited to apply for a particular bursary, fast track your application process by entering the unique code you were given here.',
        icon: UsersIcon,
        iconForeground: 'text-sky-700',
        iconBackground: 'bg-sky-50',
    },
]

const mobileMenuOpen = ref(false)
</script>

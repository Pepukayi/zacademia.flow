<script setup>
import {defineComponent, h} from "vue";
import { BuildingOffice2Icon, EnvelopeIcon, PhoneIcon } from '@heroicons/vue/24/outline'
import {Link} from "@inertiajs/vue3";

const footerNavigation = {
    solutions: [
        { name: 'Marketing', href: '#' },
        { name: 'Analytics', href: '#' },
        { name: 'Commerce', href: '#' },
        { name: 'Insights', href: '#' },
    ],
    support: [
        { name: 'Pricing', href: '#' },
        { name: 'Documentation', href: '#' },
        { name: 'Guides', href: '#' },
        { name: 'API Status', href: '#' },
    ],
    company: [
        { name: 'About', href: '#' },
        { name: 'Blog', href: '#' },
        { name: 'Jobs', href: '#' },
        { name: 'Press', href: '#' },
        { name: 'Partners', href: '#' },
    ],
    legal: [
        { name: 'Claim', href: '#' },
        { name: 'Privacy', href: '#' },
        { name: 'Terms', href: '#' },
    ],
    social: [
        {
            name: 'Twitter',
            href: 'https://twitter.com/ColminGroup',
            icon: defineComponent({
                render: () =>
                    h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
                        h('path', {
                            d: 'M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84',
                        }),
                    ]),
            }),
        },
        {
            name: 'LinkedIn',
            href: 'https://www.linkedin.com/in/colmin-group-78200b27a/',
            icon: defineComponent({
                render: () =>
                    h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
                        h('path', {
                            'fill-rule': 'evenodd',
                            d: 'M1 2.83783C1 2.35041 1.19363 1.88295 1.53829 1.53829C1.88295 1.19363 2.35041 1 2.83783 1H21.1611C21.4025 1 21.6415 1.04754 21.8644 1.1399C22.0874 1.23226 22.29 1.36763 22.4607 1.53829C22.6313 1.70895 22.7667 1.91155 22.8591 2.13452C22.9514 2.3575 22.999 2.59648 22.999 2.83783V21.1611C22.999 21.4025 22.9514 21.6415 22.8591 21.8644C22.7667 22.0874 22.6313 22.29 22.4607 22.4607C22.29 22.6313 22.0874 22.7667 21.8644 22.8591C21.6415 22.9514 21.4025 22.999 21.1611 22.999H2.83783C2.35041 22.999 1.88295 22.8053 1.53829 22.4607C1.19363 22.116 1 21.6486 1 21.1611V2.83783ZM9.70792 9.38711H12.687V10.884C13.1164 10.0232 14.2168 9.24961 15.8699 9.24961C19.0387 9.24961 19.7908 10.9628 19.7908 14.1063V19.9283H16.5826V14.8222C16.5826 13.0321 16.1532 12.0224 15.061 12.0224C13.5463 12.0224 12.9161 13.1109 12.9161 14.8222V19.9283H9.70792V9.38711ZM4.20818 19.7908H7.41637V9.24961H4.20818V19.7908ZM7.87468 5.81227C7.87468 6.08311 7.82133 6.3513 7.71769 6.60152C7.61404 6.85174 7.46212 7.0791 7.27061 7.27061C7.0791 7.46212 6.85174 7.61404 6.60152 7.71769C6.3513 7.82133 6.08311 7.87468 5.81227 7.87468C5.54144 7.87468 5.27325 7.82133 5.02303 7.71769C4.7728 7.61404 4.54545 7.46212 4.35393 7.27061C4.16242 7.0791 4.01051 6.85174 3.90686 6.60152C3.80322 6.3513 3.74987 6.08311 3.74987 5.81227C3.74987 5.26529 3.96716 4.74071 4.35393 4.35393C4.74071 3.96716 5.26529 3.74987 5.81227 3.74987C6.35926 3.74987 6.88384 3.96716 7.27061 4.35393C7.65739 4.74071 7.87468 5.26529 7.87468 5.81227Z',
                            'clip-rule': 'evenodd',
                        }),
                    ]),
            }),
        },
        {
            name: 'YouTube',
            href: 'https://www.youtube.com/watch?v=W0XpRra7lYA',
            icon: defineComponent({
                render: () =>
                    h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
                        h('path', {
                            'fill-rule': 'evenodd',
                            d: 'M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z',
                            'clip-rule': 'evenodd',
                        }),
                    ]),
            }),
        },
    ],
}
</script>

<template>
    <footer class="bg-gray-900" aria-labelledby="footer-heading">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        <div class="mx-auto max-w-7xl px-6 py-16 sm:py-12 lg:px-8 lg:py-12">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <Link href="/">
                    <img class="h-36 w-auto" src="/logos/COLMIN%20GROUP.png" alt="ColminGroup" />
                </Link>
                <div class="mt-5 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
                    <div class="md:grid md:grid-cols-1 md:gap-8">
                    </div>
                    <div class=" ml-32 md:grid md:grid-cols-1 md:gap-10">
                        <div class="mt-10 md:mt-0">
                        </div>
                        <div class="mt-10 md:mt-0">
                            <dl class="mt-10 space-y-4 text-base leading-7 text-gray-300">
                            <div class="flex gap-x-4">
                                <dt class="flex-none">
                                    <span class="sr-only">Address</span>
                                    <BuildingOffice2Icon class="h-7 w-6 text-gray-400" aria-hidden="true" />
                                </dt>
                                <dd>IFZA <br /> Dubai Silicon Oasis<br />Dubai, UAE</dd>
                            </div>
                                <div class="flex gap-x-4">
                                    <dt class="flex-none">
                                        <span class="sr-only">Address</span>
                                        <BuildingOffice2Icon class="h-7 w-6 text-gray-400" aria-hidden="true" />
                                    </dt>
                                    <dd>Innovation Work <br /> Halfway House<br />Midrand, South Africa</dd>
                                </div>
<!--                            <div class="flex gap-x-4">-->
<!--                                <dt class="flex-none">-->
<!--                                    <span class="sr-only">Telephone</span>-->
<!--                                    <PhoneIcon class="h-7 w-6 text-gray-400" aria-hidden="true" />-->
<!--                                </dt>-->
<!--                                <dd><a class="hover:text-white" href="tel:+1 (555) 234-5678">+1 (555) 234-5678</a></dd>-->
<!--                            </div>-->
                            <div class="flex gap-x-4">
                                <dt class="flex-none">
                                    <span class="sr-only">Email</span>
                                    <EnvelopeIcon class="h-7 w-6 text-gray-400" aria-hidden="true" />
                                </dt>
                                <dd><a class="hover:text-white" href="mailto:info@colmin.co.za">admin@colmingroup.com</a></dd>
                            </div>
                        </dl>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 border-t border-white/10 pt-2 sm:mt-20 md:flex md:items-center md:justify-between lg:mt-12">
                <div class="flex space-x-6 md:order-2">
                    <a v-for="item in footerNavigation.social" :key="item.name" :href="item.href" class="text-gray-500 hover:text-gray-400">
                        <span class="sr-only">{{ item.name }}</span>
                        <component :is="item.icon" class="h-6 w-6" aria-hidden="true" />
                    </a>
                </div>
                <p class="mt-8 text-xs leading-5 text-gray-400 md:order-1 md:mt-0">&copy; 2023 Colmin Group. All rights reserved. Developed by <a href="https://zaziri.com" target="_blank">Zaziri</a>.</p>
            </div>
        </div>
    </footer>
</template>

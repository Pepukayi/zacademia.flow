<template>
    <div>
        <TransitionRoot as="template" :show="sidebarOpen">
            <Dialog class="relative z-50 lg:hidden" @close="sidebarOpen = false">
                <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-900/80" />
                </TransitionChild>

                <div class="fixed inset-0 flex">
                    <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
                        <DialogPanel class="relative mr-16 flex w-full max-w-xs flex-1">
                            <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-300" leave-from="opacity-100" leave-to="opacity-0">
                                <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                                    <button type="button" class="-m-2.5 p-2.5" @click="sidebarOpen = false">
                                        <span class="sr-only">Close sidebar</span>
                                        <XMarkIcon class="h-6 w-6 text-white" aria-hidden="true" />
                                    </button>
                                </div>
                            </TransitionChild>
                            <!-- Sidebar component, swap this element with another sidebar if you like -->
                            <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-gray-900 px-6 pb-4 ring-1 ring-white/10">
                                <div class="flex h-16 shrink-0 items-center">
<!--                                    <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" />-->
                                    <p class="h-8 w-auto text-white group flex gap-x-3 rounded-md p-2 text-lg leading-6 font-semibold">Zacademia.Flow</p>
                                </div>
                                <nav class="flex flex-1 flex-col">
                                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                                        <li>
                                            <ul role="list" class="-mx-2 space-y-1">
                                                <li v-for="item in navigation" :key="item.name">
                                                    <Link :href="item.href" :class="[item.current ? 'bg-gray-800 text-white' : 'text-gray-400 hover:text-white hover:bg-mostepe-green-light', 'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold']">
                                                        <component :is="item.icon" class="h-6 w-6 shrink-0" aria-hidden="true" />
                                                        {{ item.name }}
                                                    </Link>
                                                </li>
                                            </ul>
                                        </li>
<!--                                        <li>-->
<!--                                            <div class="text-xs font-semibold leading-6 text-gray-400">Your teams</div>-->
<!--                                            <ul role="list" class="-mx-2 mt-2 space-y-1">-->
<!--                                                <li v-for="team in teams" :key="team.name">-->
<!--                                                    <a :href="team.href" :class="[team.current ? 'bg-gray-800 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800', 'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold']">-->
<!--                                                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border border-gray-700 bg-gray-800 text-[0.625rem] font-medium text-gray-400 group-hover:text-white">{{ team.initial }}</span>-->
<!--                                                        <span class="truncate">{{ team.name }}</span>-->
<!--                                                    </a>-->
<!--                                                </li>-->
<!--                                            </ul>-->
<!--                                        </li>-->
                                        <li class="mt-auto">
                                            <a href="#" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-400 hover:bg-gray-800 hover:text-white">
                                                <Cog6ToothIcon class="h-6 w-6 shrink-0" aria-hidden="true" />
                                                Settings
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </Dialog>
        </TransitionRoot>

        <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-mostepe-green-dark px-6 pb-4">
                <div class="flex h-16 shrink-0 items-center">
<!--                    <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" />-->
                    <p class="h-8 w-auto text-white group flex gap-x-3 rounded-md p-2 text-lg leading-6 font-semibold">Zacademia.Flow</p>
                </div>
                <nav class="flex flex-1 flex-col">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2 space-y-1">
                                <li v-for="item in navigation" :key="item.name">
                                    <Link :href="item.href" :class="[item.current ? 'bg-mostepe-green-light text-white' : 'text-gray-400 hover:text-white hover:bg-mostepe-green-light', 'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold']">
                                        <component :is="item.icon" class="h-6 w-6 shrink-0" aria-hidden="true" />
                                        {{ item.name }}
                                    </Link>
                                </li>
                            </ul>
                        </li>
<!--                        <li>-->
<!--                            <div class="text-xs font-semibold leading-6 text-gray-400">Your teams</div>-->
<!--                            <ul role="list" class="-mx-2 mt-2 space-y-1">-->
<!--                                <li v-for="team in teams" :key="team.name">-->
<!--                                    <a :href="team.href" :class="[team.current ? 'bg-gray-800 text-white' : 'text-gray-400 hover:text-white hover:bg-mostepe-green-light', 'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold']">-->
<!--                                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border border-gray-700 bg-gray-800 text-[0.625rem] font-medium text-gray-400 group-hover:text-white">{{ team.initial }}</span>-->
<!--                                        <span class="truncate">{{ team.name }}</span>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </li>-->
                        <li class="mt-auto">
                            <a href="#" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-400 hover:bg-mostepe-green-light hover:text-white">
                                <Cog6ToothIcon class="h-6 w-6 shrink-0" aria-hidden="true" />
                                Settings
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="sticky top-0 z-40 flex items-center gap-x-6 bg-white px-4 py-4 shadow-sm sm:px-6 lg:hidden">
            <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="sidebarOpen = true">
                <span class="sr-only">Open sidebar</span>
                <Bars3Icon class="h-6 w-6" aria-hidden="true" />
            </button>
            <div class="flex-1 text-sm font-semibold leading-6 text-gray-900">Dashboard</div>
            <a href="#">
                <span class="sr-only">Your profile</span>
                <img class="h-8 w-8 rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
            </a>
        </div>

<!--        <main class="py-10 lg:pl-72">-->
<!--            <div class="px-4 sm:px-6 lg:px-8">-->
<!--                &lt;!&ndash; Your content &ndash;&gt;-->
<!--            </div>-->
<!--        </main>-->
    </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Dialog, DialogPanel, TransitionChild, TransitionRoot } from '@headlessui/vue'
import {
    Bars3Icon,
    CalendarIcon,
    ChartPieIcon,
    DocumentDuplicateIcon,
    FolderIcon,
    HomeIcon,
    UsersIcon,
    UserCircleIcon,
    ArrowsRightLeftIcon,
    ShoppingBagIcon,
    XMarkIcon,
    CurrencyDollarIcon, PresentationChartBarIcon, PencilSquareIcon, Cog6ToothIcon
} from '@heroicons/vue/24/outline'
import {Link} from "@inertiajs/vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import NavLink from "@/Shared/NavLink.vue";
import { usePage } from '@inertiajs/vue3'
// import {PencilSquareIcon} from "@heroicons/vue/24/solid";
// import {PencilSquareIcon} from "@heroicons/vue/20/solid";

const page = usePage()

const user = computed(() => page.props.auth.user)

let props = defineProps({
    user_details: Object,
});

const navigation = [
    { name: 'Dashboard', href: '/dashboard', icon: HomeIcon, current: true },
    // { name: 'Team', href: '#', icon: UsersIcon, current: false, display: page.props.auth.user.is_admin >= 1 },
    // { name: 'Projects', href: '#', icon: FolderIcon, current: false },
    // { name: 'Calendar', href: '#', icon: CalendarIcon, current: false },
    // { name: 'Documents', href: '#', icon: DocumentDuplicateIcon, current: false },
    // { name: 'Reports', href: '#', icon: ChartPieIcon, current: false },
]
const teams = [
    // { id: 1, name: 'Heroicons', href: '#', initial: 'H', current: false },
    // { id: 2, name: 'Tailwind Labs', href: '#', initial: 'T', current: false },
    // { id: 3, name: 'Workcation', href: '#', initial: 'W', current: false },
]

const sidebarOpen = ref(false)
</script>

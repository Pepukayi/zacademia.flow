<template>
    <Head title="Register" />
    <AuthenticationCard>
        <template #logo-left>
            <img class="h-36 w-auto" src="/img/motsepe-foundation-logo.png" alt="" />
        </template>
        <ApplicationProgressBar :steps="steps" />
        <PersonalInformation />
    </AuthenticationCard>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import ApplicationProgressBar from "@/Components/ApplicationProgressBar.vue";
import PersonalInformation from "@/Components/PersonalInformation.vue";

const steps = [
    { id: '01', name: 'Personal Information', href: '#', status: 'current' },
    { id: '02', name: 'School and Results', href: '#', status: 'upcoming' },
    { id: '03', name: 'Target Studies', href: '#', status: 'upcoming' },
    { id: '04', name: 'Agreements', href: '#', status: 'upcoming' },
]
</script>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import DashboardWelcome from "@/Pages/DashboardWelcome.vue";
import ZacademiaAppLayout from "@/Layouts/ZacademiaAppLayout.vue";
</script>

<template>
    <ZacademiaAppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <DashboardWelcome />
                </div>
            </div>
        </div>
    </ZacademiaAppLayout>
</template>

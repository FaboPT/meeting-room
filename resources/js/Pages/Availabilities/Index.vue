<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, usePage} from '@inertiajs/vue3';
import SearchAvailabityForm from "@/Pages/Availabilities/Partials/SearchAvailabityForm.vue";
import CreateBookingForm from "@/Pages/Bookings/Partials/CreateBookingForm.vue";
import ListAvailabilities from "@/Pages/Availabilities/Partials/ListAvailabilities.vue";

const { availabilities } = usePage().props;
console.log(availabilities);

</script>

<template>
    <Head title="Availabilities"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Availabilities</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <SearchAvailabityForm class="max-w-xl"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-12" v-if="availabilities && availabilities.length > 0">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <ListAvailabilities :availabilities="availabilities" class="max-w-xl"/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

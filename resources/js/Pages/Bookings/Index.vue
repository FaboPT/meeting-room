<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, usePage, Link} from '@inertiajs/vue3';
import ListBookings from "@/Pages/Bookings/Partials/ListBookings.vue";

const { bookings } = usePage().props;

const createBooking = () => {
    // Navigate to the 'booking.create' route
    route('booking.create');
};
</script>

<template>
    <Head title="Bookings"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Bookings</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <Link :href="route('booking.create')"
                              class="items-center px-4 py-2 bg-gray-800 border border-transparent
                          rounded-md font-semibold text-xs text-white uppercase tracking-widest
                          hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2
                          focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 float-right"
                        >
                            Create Booking
                        </Link>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <ListBookings
                            :bookings="bookings"
                        />
                    </div>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>
</template>

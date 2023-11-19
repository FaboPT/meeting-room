<script setup>

import { defineProps } from 'vue';

const props = defineProps([ 'bookings']);

const formatDateTime = (dateTimeString) => {
    const options = { year: 'numeric', month: 'short', day: 'numeric', hour: 'numeric', minute: 'numeric' };
    const dateTime = new Date(dateTimeString);
    return dateTime.toLocaleString('nl-BE', options);
};

</script>

<template>
    <section>
        <h2 class="font-semibold ">Bookings</h2>
        <div>
            <ul>
                <li v-for="booking in bookings" :key="booking.id">
                    {{ formatDateTime(booking.start_date) }} - {{ formatDateTime(booking.end_date) }} <b> Booked for: </b> {{ booking.booked_for }} <b>Room:</b> {{ booking.room.name }}
            </li>
        </ul>
        </div>
    </section>
</template>

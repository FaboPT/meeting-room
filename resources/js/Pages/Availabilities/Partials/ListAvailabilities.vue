<script setup>

import { defineProps } from 'vue';

const props = defineProps(['availabilities']);

const formatDateTime = (dateTimeString) => {
    const options = { year: 'numeric', month: 'short', day: 'numeric', hour: 'numeric', minute: 'numeric' };
    const dateTime = new Date(dateTimeString);
    return dateTime.toLocaleString('nl-BE', options);
};

</script>

<template>
    <section>
        <div>
            <h2>Availabilities</h2>
            <ul>
                <li v-for="availability in availabilities" :key="availability.room.id">
                    <strong>{{ availability.room.name }}</strong>
                    <ul v-if="availability.available_dates[0].start">
                        <li v-for="dateRange in availability.available_dates" :key="dateRange.start">
                            {{ formatDateTime(dateRange.start) }} - {{ formatDateTime(dateRange.end) }}
                        </li>
                    </ul>
                    <div v-else>
                        {{ availability.available_dates[0] }}
                    </div>
                </li>
            </ul>

        </div>
    </section>
</template>

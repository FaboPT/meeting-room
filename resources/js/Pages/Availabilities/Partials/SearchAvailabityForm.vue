<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';
import TextInput from '@/Components/TextInput.vue';
import {useForm, usePage} from '@inertiajs/vue3';
import {ref} from 'vue';

const dateBooking = ref(null);
const participants = ref(null);


const form = useForm({
    date_booking: '',
    participants: '',
});


const searchAvailability = () => {
    form.post(route('availability.search'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.date_booking) {
                form.reset('date_booking');
                dateBooking.value.focus();
            }
            if (form.errors.participants) {
                form.reset('participants');
                participants.value.focus();
            }
        },
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Search Availability</h2>
        </header>

        <form class="mt-6 space-y-6" @submit.prevent="searchAvailability">
            <div>
                <InputLabel for="date_booking" value="Date for booking"/>

                <TextInput
                    id="date_booking"
                    ref="dateBooking"
                    v-model="form.date_booking"
                    autocomplete="date-booking"
                    class="mt-1 block w-full"
                    type="date"
                    required="required"
                />

                <InputError :message="form.errors.date_booking" class="mt-2"/>
            </div>

            <div>
                <InputLabel for="participants" value="Participants"/>

                <TextInput
                    id="participants"
                    ref="participants"
                    v-model="form.participants"
                    autocomplete="participants"
                    class="mt-1 block w-full"
                    type="number"
                    :placeholder="'How many participants?'"
                    required=required
                />

                <InputError :message="form.errors.participants" class="mt-2"/>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">search</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Searched.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>

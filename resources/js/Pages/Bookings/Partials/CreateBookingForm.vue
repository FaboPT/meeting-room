<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';
import TextInput from '@/Components/TextInput.vue';
import {useForm, usePage} from '@inertiajs/vue3';
import {ref} from 'vue';

const startDate = ref(null);
const endDate = ref(null);
const { rooms } = usePage().props;


const form = useForm({
    start_date: '',
    end_date: '',
    booked_for: '',
    room_id: '',
});


const createBooking = () => {
    form.post(route('booking.store'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.start_date) {
                form.reset('start_date', 'end_date');
                startDate.value.focus();
            }
            if (form.errors.end_date) {
                form.reset('end_date');
                endDate.value.focus();
            }
        },
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Create Booking</h2>
        </header>

        <form class="mt-6 space-y-6" @submit.prevent="createBooking">
            <div>
                <InputLabel for="start_date" value="Start Date"/>

                <TextInput
                    id="start_date"
                    ref="startDate"
                    v-model="form.start_date"
                    autocomplete="start-date"
                    class="mt-1 block w-full"
                    type="datetime-local"
                    required="required"
                />

                <InputError :message="form.errors.start_date" class="mt-2"/>
            </div>

            <div>
                <InputLabel for="end_date" value="End Date"/>

                <TextInput
                    id="end_date"
                    ref="endDate"
                    v-model="form.end_date"
                    autocomplete="end-date"
                    class="mt-1 block w-full"
                    type="datetime-local"
                    required=required
                />

                <InputError :message="form.errors.end_date" class="mt-2"/>
            </div>

            <div>
                <InputLabel for="booked_for" value="Book By"/>

                <TextInput
                    id="booked_for"
                    v-model="form.booked_for"
                    autocomplete="booked-for"
                    class="mt-1 block w-full"
                    placeholder="email@email.com"
                    type="email"
                    required="required"
                />

                <InputError :message="form.errors.booked_for" class="mt-2"/>
            </div>
            <div>
                <InputLabel for="room_id" value="Room"/>

                <SelectInput
                    v-model="form.room_id"
                    name="room"
                    id="room_id"
                    autocomplete="room_id"
                    class="mt-1 block w-full"
                    :rooms="rooms"
                >
                    <option class="mt-1 block w-full" v-for="room in rooms" :key="room.id" :value="room.id">{{ room.name }}</option>
                </SelectInput>

                <InputError :message="form.errors.room_id" class="mt-2"/>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">create</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>

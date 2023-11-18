<script setup>
import {onMounted, ref} from 'vue';

defineProps({
    modelValue: {
        type: String,
        required: true,
    },
    placeholder: String,
    required: Boolean,
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({focus: () => input.value.focus()});
</script>

<template>
    <input
        ref="input"
        :value="modelValue"
        :placeholder="placeholder"
        :required="required"
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        @input="$emit('update:modelValue', $event.target.value)"
    />
</template>

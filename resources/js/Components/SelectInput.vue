<script setup>
    import { onMounted, ref } from 'vue';

    defineProps({
    modelValue: {
    type: [String, Number],
    required: true,
},
    label: String,
    name: String,
});

    defineEmits(['update:modelValue']);

    const selectInput = ref(null);

    onMounted(() => {
    if (selectInput.value.hasAttribute('autofocus')) {
    selectInput.value.focus();
}
});

    defineExpose({ focus: () => selectInput.value.focus() });
</script>
<template>
    <div>
        <label :for="name">{{ label }}</label>
        <select
            ref="selectInput"
            :value="modelValue"
            required="required"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            @input="$emit('update:modelValue', $event.target.value)"
        >
            <slot></slot>
        </select>
    </div>
</template>




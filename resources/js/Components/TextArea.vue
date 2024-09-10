<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    
    required: true,
});

const textarea = ref(null);



defineExpose({ focus: () => textarea.value.focus() });
</script>

<template>
    <textarea
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        v-model="model"
        ref="input"
    />
</template>

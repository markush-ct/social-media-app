<script setup>
import { ref, onMounted } from "vue";

const model = defineModel({
    type: String,
});

const props = defineProps({
    placeholder: String,
    autoresize: {
        type: Boolean,
        default: true,
    },
});

const textarea = ref(null);

const resizeTextarea = () => {
    if (props.autoresize) {
        textarea.value.style.height = "auto";
        textarea.value.style.height = textarea.value.scrollHeight + "px";
    }
};

onMounted(() => {
    resizeTextarea();
});
</script>

<template>
    <textarea
        v-model="model"
        ref="textarea"
        @input="resizeTextarea"
        name="post"
        id="post"
        :placeholder="placeholder"
        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
    ></textarea>
</template>

<style scoped></style>

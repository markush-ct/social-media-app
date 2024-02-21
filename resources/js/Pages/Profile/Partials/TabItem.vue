<script setup>
defineProps({
    selected: Boolean,
    text: String,
});
</script>

<template>
    <button
        class="outline-none"
        :class="{
            'border-b-2 border-indigo-400 dark:border-indigo-600': selected,
            'hover:bg-gray-200 dark:hover:bg-gray-700 hover:rounded-md':
                !selected,
        }"
    >
        {{ text }}
    </button>
</template>

<style scoped></style>

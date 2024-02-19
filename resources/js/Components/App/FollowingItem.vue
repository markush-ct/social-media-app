<script setup>
defineProps({
    image: String,
    title: String,
});
</script>

<template>
    <div
        class="flex items-center gap-3 hover:bg-gray-200 dark:hover:bg-gray-700 cursor-pointer p-3 rounded-md"
    >
        <img :src="image" alt="Random Photo" class="w-[32px] rounded-full" />
        <div>
            <h3 class="text-md">{{ title }}</h3>
        </div>
    </div>
</template>

<style scoped></style>

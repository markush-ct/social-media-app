<script setup>
defineProps({
    image: String,
    title: String,
    description: String,
});
</script>

<template>
    <div
        class="flex items-start gap-3 hover:bg-gray-200 dark:hover:bg-gray-700 cursor-pointer p-3 rounded-md"
    >
        <img :src="image" alt="Random Photo" class="w-[48px] rounded-full" />
        <div>
            <h3 class="text-xl font-bold">{{ title }}</h3>
            <div class="text-xs text-gray-600 dark:text-gray-400">
                {{ description }}
            </div>
        </div>
    </div>
</template>

<style scoped></style>

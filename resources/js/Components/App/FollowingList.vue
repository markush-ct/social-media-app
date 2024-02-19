<script setup>
import { ref } from "vue";
import TextInput from "@/Components/TextInput.vue";
import FollowingItem from "./FollowingItem.vue";

const searchKeyword = ref("");
</script>

<template>
    <div class="space-y-3">
        <h2 class="text-2xl font-bold flex items-center gap-3">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
                className="w-6 h-6"
                class="w-[32px]"
            >
                <path
                    fillRule="evenodd"
                    d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                    clipRule="evenodd"
                />
            </svg>

            My Friends
        </h2>
        <TextInput
            :model-value="searchKeyword"
            placeholder="Type to search"
            class="w-full"
        />
        <div v-if="false" class="text-center text-gray-400 py-6">
            You don't have any friends yet.
        </div>
        <div v-else class="space-y-3">
            <FollowingItem
                image="https://picsum.photos/100"
                title="Juan Dela Cruz"
            />
            <FollowingItem
                image="https://picsum.photos/100"
                title="Madeline Ponce"
            />
            <FollowingItem
                image="https://picsum.photos/100"
                title="Alexia Cortes"
            />
        </div>
    </div>
</template>

<style scoped></style>

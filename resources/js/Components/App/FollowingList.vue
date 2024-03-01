<script setup>
import { ref } from "vue";
import TextInput from "@/Components/TextInput.vue";
import FollowingItem from "./FollowingItem.vue";
import { UserIcon } from "@heroicons/vue/24/solid";

const searchKeyword = ref("");
</script>

<template>
    <div class="space-y-3 px-3 pb-6 w-full h-full overflow-auto">
        <div class="space-y-3 sticky py-6 top-0 bg-gray-100 dark:bg-gray-900">
            <h2 class="text-2xl font-bold flex items-center gap-3">
                <UserIcon class="icon-32" />
                My Friends
            </h2>
            <TextInput
                :model-value="searchKeyword"
                placeholder="Type to search"
                class="w-full"
            />
        </div>
        <div v-if="false" class="text-center text-gray-400 py-6">
            You don't have any friends yet.
        </div>
        <div v-else>
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

<script setup>
import { ref } from "vue";
import GroupItem from "@/Components/App/GroupItem.vue";
import TextInput from "@/Components/TextInput.vue";
import { UserGroupIcon } from "@heroicons/vue/24/solid";

const searchKeyword = ref("");
</script>

<template>
    <div class="space-y-3 px-3 pb-6 w-full h-full overflow-auto">
        <div class="space-y-3 sticky py-6 top-0 bg-gray-100 dark:bg-gray-900">
            <h2 class="text-2xl font-bold flex items-center gap-3">
                <UserGroupIcon class="icon-32" />
                My Groups
            </h2>
            <TextInput
                :model-value="searchKeyword"
                placeholder="Type to search"
                class="w-full"
            />
        </div>
        <div v-if="false" class="text-center text-gray-400 py-6">
            You are not joined to any groups
        </div>
        <div v-else>
            <GroupItem
                image="https://picsum.photos/100"
                title="Laravel Developers"
                description="Lorem ipsum dolor sit amet consectetur adipisicing elit."
            />
            <GroupItem
                image="https://picsum.photos/100"
                title="Markush Graphics"
                description="Lorem ipsum dolor sit amet consectetur adipisicing elit."
            />
            <GroupItem
                image="https://picsum.photos/100"
                title="Other Group"
                description="Lorem ipsum dolor sit amet consectetur adipisicing elit."
            />
            <GroupItem
                image="https://picsum.photos/100"
                title="Other Group"
                description="Lorem ipsum dolor sit amet consectetur adipisicing elit."
            />
        </div>
    </div>
</template>

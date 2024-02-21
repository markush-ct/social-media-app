<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from "@headlessui/vue";
import TabItem from "./Partials/TabItem.vue";
import { Head, usePage, Link } from "@inertiajs/vue3";
import { computed } from "vue";

const authUser = usePage().props.auth.user;
const user = usePage().props.user;
const isMyProfile = computed(() => (authUser && authUser.id) === user.id);

defineProps({
    user: {
        type: Object,
    },
});
</script>
<template>
    <Head :title="user.name" />

    <div
        class="bg-gray-100 dark:bg-gray-900 min-h-screen text-gray-900 dark:text-gray-100"
    >
        <TabGroup>
            <div class="bg-white dark:bg-gray-800">
                <div class="max-w-6xl mx-auto">
                    <div class="h-[400px]">
                        <div
                            class="overflow-hidden h-full rounded-b-lg relative shadow-inner"
                        >
                            <img
                                src="https://picsum.photos/1000"
                                alt="Cover Photo"
                                class="w-full h-full object-cover object-center"
                            />
                            <div
                                class="shadow-[0_0_500px_150px_rgba(0,0,0,0.75)] absolute w-full h-full"
                            ></div>
                        </div>
                    </div>
                    <div class="px-3 md:px-8">
                        <div
                            class="flex items-center flex-col lg:flex-row gap-8"
                        >
                            <div class="relative w-full lg:w-[150px] h-[100px]">
                                <div
                                    class="h-[150px] w-[150px] rounded-full bg-white absolute bottom-0 lg:left-0 left-1/2 transform -translate-x-1/2 lg:transform-none overflow-hidden border-white dark:border-gray-800 border-4"
                                >
                                    <img
                                        src="https://xsgames.co/randomusers/assets/avatars/male/74.jpg"
                                        alt="Avatar Profile"
                                    />
                                </div>
                            </div>
                            <div
                                class="flex flex-col lg:flex-row lg:items-end lg:w-[calc(100%-150px)] gap-3"
                            >
                                <div class="text-center lg:text-left w-full">
                                    <h1 class="text-4xl font-bold">
                                        {{ user.name }}
                                    </h1>
                                    <a href="#" class="text-sm">
                                        {{ user.email }} - {{ user.username }}
                                    </a>
                                </div>
                                <div
                                    v-if="isMyProfile"
                                    class="text-center lg:text-right w-full"
                                >
                                    <Link :href="route('profile.edit')">
                                        <PrimaryButton>
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                strokeWidth="{1.5}"
                                                stroke="currentColor"
                                                className="w-6 h-6"
                                                class="w-[18px] mr-2"
                                            >
                                                <path
                                                    strokeLinecap="round"
                                                    strokeLinejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"
                                                />
                                            </svg>

                                            Edit Profile
                                        </PrimaryButton>
                                    </Link>
                                </div>
                            </div>
                        </div>

                        <hr
                            class="h-px bg-gray-200 border-0 dark:bg-gray-600 mt-3"
                        />
                    </div>
                </div>
            </div>

            <TabList class="bg-white dark:bg-gray-800 sticky top-0 shadow">
                <div class="max-w-6xl mx-auto px-3 md:px-8">
                    <Tab as="template" v-slot="{ selected }" class="p-3">
                        <TabItem text="About" :selected="selected" />
                    </Tab>
                    <Tab as="template" v-slot="{ selected }" class="p-3">
                        <TabItem text="Posts" :selected="selected" />
                    </Tab>
                    <Tab as="template" v-slot="{ selected }" class="p-3">
                        <TabItem text="Followers" :selected="selected" />
                    </Tab>
                    <Tab as="template" v-slot="{ selected }" class="p-3">
                        <TabItem text="Followings" :selected="selected" />
                    </Tab>
                    <Tab as="template" v-slot="{ selected }" class="p-3">
                        <TabItem text="Photos" :selected="selected" />
                    </Tab>
                </div>
            </TabList>

            <div class="max-w-6xl mx-auto mt-3 px-3 md:px-8">
                <TabPanels
                    class="bg-white dark:bg-gray-800 shadow min-h-screen p-3 rounded-md"
                >
                    <TabPanel>About</TabPanel>
                    <TabPanel>Posts</TabPanel>
                    <TabPanel>Followers</TabPanel>
                    <TabPanel>Folowings</TabPanel>
                    <TabPanel>Photos</TabPanel>
                </TabPanels>
            </div>
        </TabGroup>
    </div>
</template>

<style scoped></style>

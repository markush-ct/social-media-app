<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from "@headlessui/vue";

defineProps({
    user: {
        type: Object,
    },
});
</script>
<template>
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
                                <div class="text-center lg:text-right w-full">
                                    <PrimaryButton>Edit Profile</PrimaryButton>
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
                <div class="max-w-6xl mx-auto px-3 md:px-8 py-1">
                    <Tab
                        class="p-3 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700"
                    >
                        About
                    </Tab>
                    <Tab
                        class="p-3 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700"
                    >
                        Posts
                    </Tab>
                    <Tab
                        class="p-3 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700"
                    >
                        Followers
                    </Tab>
                    <Tab
                        class="p-3 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700"
                    >
                        Followings
                    </Tab>
                    <Tab
                        class="p-3 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700"
                    >
                        Photos
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

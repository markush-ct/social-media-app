<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from "@headlessui/vue";
import TabItem from "./Partials/TabItem.vue";
import { Head, usePage, Link } from "@inertiajs/vue3";
import { computed } from "vue";
import {
    CameraIcon,
    GlobeAsiaAustraliaIcon,
    XMarkIcon,
} from "@heroicons/vue/24/solid";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const authUser = usePage().props.auth.user;
const otherUser = usePage().props.user;
const isMyProfile = computed(() => (authUser && authUser.id) === otherUser.id);
const coverImageSrc = ref(null);
const avatarImageSrc = ref(null);
const isChangingImage = ref(false);
const showStatusToast = ref(false);

defineProps({
    user: Object,
    status: String,
    errors: Object,
});

// Forms
const imageForm = useForm({
    cover: null,
    avatar: null,
});

const openCoverInput = () => {
    document.getElementById("cover-photo").click();
};

const openAvatarInput = () => {
    document.getElementById("avatar-photo").click();
};

const onCoverChange = (e) => {
    imageForm.cover = e.target.files[0];
    isChangingImage.value = true;

    if (imageForm.cover) {
        const reader = new FileReader();
        reader.onload = () => {
            coverImageSrc.value = reader.result;
        };
        reader.readAsDataURL(imageForm.cover);
    }
};

const onAvatarChange = (e) => {
    imageForm.avatar = e.target.files[0];
    isChangingImage.value = true;

    if (imageForm.avatar) {
        const reader = new FileReader();
        reader.onload = () => {
            avatarImageSrc.value = reader.result;
        };
        reader.readAsDataURL(imageForm.avatar);
    }
};

const imageReset = () => {
    coverImageSrc.value = null;
    avatarImageSrc.value = null;
    isChangingImage.value = false;

    imageForm.reset();
};

const onImageCancel = () => {
    imageReset();
};

const closeStatusToast = () => (showStatusToast.value = false);

const submitCoverImage = () => {
    imageForm.post(route("profile.updateImages"), {
        preserveScroll: true,
        onSuccess: () => {
            imageReset();
            showStatusToast.value = true;
            setTimeout(() => {
                showStatusToast.value = false;
            }, 5000);
        },
    });
};
</script>
<template>
    <Head :title="user.name" />

    <!-- For uploading images that should be hidden -->
    <input
        type="file"
        accept="image/png, image/jpeg"
        id="cover-photo"
        class="hidden"
        @change="onCoverChange"
    />
    <input
        type="file"
        accept="image/png, image/jpeg"
        id="avatar-photo"
        class="hidden"
        @change="onAvatarChange"
    />

    <AuthenticatedLayout>
        <div
            class="bg-gray-100 dark:bg-gray-900 min-h-screen text-gray-900 dark:text-gray-100 relative"
        >
            <div
                v-show="showStatusToast"
                class="fixed z-50 top-20 lg:right-3 -right-1/2 transform -translate-x-1/2 lg:transform-none p-3 w-full lg:max-w-[30%] bg-green-800 rounded-md flex gap-2 items-start justify-between bg-opacity-80 outline outline-1 outline-green-600"
            >
                <span>{{ status }}</span>
                <span class="shrink-0">
                    <XMarkIcon class="w-[24px]" @click="closeStatusToast" />
                </span>
            </div>
            <div
                v-if="coverImageSrc"
                class="fixed bg-gray-900 bg-opacity-75 w-full z-50 py-3 px-8 flex justify-between items-center"
            >
                <div class="inline-flex gap-2">
                    <GlobeAsiaAustraliaIcon class="w-[18px]" />
                    Your cover photo is public.
                </div>
                <div class="space-x-3">
                    <PrimaryButton @click="onImageCancel">
                        Cancel
                    </PrimaryButton>
                    <PrimaryButton @click="submitCoverImage">
                        Save changes
                    </PrimaryButton>
                </div>
            </div>

            <div
                v-if="avatarImageSrc"
                class="fixed bg-gray-900 bg-opacity-75 w-full z-50 py-3 px-8 flex justify-between items-center"
            >
                <div class="inline-flex gap-2">
                    <GlobeAsiaAustraliaIcon class="w-[18px]" />
                    Your avatar photo is public.
                </div>
                <div class="space-x-3">
                    <PrimaryButton @click="onImageCancel">
                        Cancel
                    </PrimaryButton>
                    <PrimaryButton @click="submitCoverImage">
                        Save changes
                    </PrimaryButton>
                </div>
            </div>

            <TabGroup>
                <div class="bg-white dark:bg-gray-800">
                    <div class="max-w-6xl mx-auto">
                        <div class="h-[400px]">
                            <div
                                class="overflow-hidden h-full rounded-b-lg relative shadow-inner"
                            >
                                <img
                                    :src="
                                        coverImageSrc ||
                                        user.cover_url ||
                                        'https://picsum.photos/1000'
                                    "
                                    alt="Cover Photo"
                                    class="w-full h-full object-cover object-center"
                                />
                                <PrimaryButton
                                    class="absolute bottom-3 right-3 lg:right-8 z-40 shadow"
                                    @click="openCoverInput"
                                    v-if="!isChangingImage && isMyProfile"
                                >
                                    <CameraIcon class="w-[18px] lg:mr-2" />
                                    <span class="hidden lg:block">
                                        Add cover photo
                                    </span>
                                </PrimaryButton>
                                <div
                                    class="shadow-[0_0_500px_150px_rgba(0,0,0,0.75)] absolute w-full h-full"
                                ></div>
                            </div>
                        </div>
                        <div class="px-3 md:px-8">
                            <div
                                class="flex items-center flex-col lg:flex-row gap-8"
                            >
                                <div
                                    class="relative w-full lg:w-[150px] h-[100px]"
                                >
                                    <div
                                        class="h-[150px] w-[150px] absolute bottom-0 lg:left-0 left-1/2 transform -translate-x-1/2 lg:transform-none"
                                    >
                                        <button
                                            v-if="
                                                !isChangingImage && isMyProfile
                                            "
                                            @click="openAvatarInput"
                                            class="overflow-visible absolute bottom-0 right-2 inline-flex items-center p-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-full text-white dark:text-gray-800 hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 shadow z-40"
                                        >
                                            <CameraIcon class="w-[18px]" />
                                        </button>
                                        <img
                                            :src="
                                                avatarImageSrc ||
                                                user.avatar_url ||
                                                'https://xsgames.co/randomusers/assets/avatars/male/74.jpg'
                                            "
                                            alt="Avatar Profile"
                                            class="rounded-full border-white dark:border-gray-800 border-4 object-cover object-center w-full h-full"
                                        />
                                    </div>
                                </div>
                                <div
                                    class="flex flex-col lg:flex-row lg:items-end lg:w-[calc(100%-150px)] gap-3"
                                >
                                    <div
                                        class="text-center lg:text-left w-full"
                                    >
                                        <h1 class="text-4xl font-bold">
                                            {{ user.name }}
                                        </h1>
                                        <a href="#" class="text-sm">
                                            {{ user.email }} -
                                            {{ user.username }}
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

                <TabList
                    class="bg-white dark:bg-gray-800 sticky top-[58px] shadow z-40 text-sm"
                >
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
    </AuthenticatedLayout>
</template>

<style scoped></style>

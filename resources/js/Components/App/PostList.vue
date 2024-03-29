<script setup>
import { ref } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import PostItem from "./PostItem.vue";
import Modal from "@/Components/Modal.vue";
import InputTextArea from "@/Components/InputTextArea.vue";
import PrimaryButton from "../PrimaryButton.vue";
import ToastNotification from "../ToastNotification.vue";
import { XMarkIcon } from "@heroicons/vue/24/solid";

const props = defineProps({
    posts: Object,
    status: Object,
    errors: Object,
});

const postItemEditing = ref(false);
const postItem = ref(null);
const showNotification = ref(false);

const updatePostItemForm = useForm({
    body: null,
});

const getPostItem = (data) => {
    if (data) {
        postItemEditing.value = true;
        postItem.value = data;
        updatePostItemForm.body = data.body;
    }
};

const closeModal = () => {
    postItemEditing.value = false;
    postItem.value = null;
};

const handleUpdatePostItem = () => {
    updatePostItemForm.patch(route("posts.update", postItem.value), {
        preserveScroll: true,
        onSuccess: () => {
            postItemEditing.value = false;
            showNotification.value = true;
            setTimeout(() => (showNotification.value = false), 5000);
        },
        onError: () => {
            showNotification.value = true;
            setTimeout(() => (showNotification.value = false), 5000);
        },
    });
};

const handleDeletePostItem = (post) => {
    if (window.confirm("Are you sure you want to delete this post?")) {
        router.delete(route("posts.destroy", post), {
            preserveScroll: true,
            onSuccess: () => {
                showNotification.value = true;
                setTimeout(() => (showNotification.value = false), 5000);
            },
            onError: () => {
                showNotification.value = true;
                setTimeout(() => (showNotification.value = false), 5000);
            },
        });
    }
};

const closeNotification = () => {
    showNotification.value = false;
};
</script>

<template>
    <div class="space-y-3">
        <PostItem
            v-for="post of posts"
            :post="post"
            :key="post.id"
            @sendPostItem="getPostItem"
            @sendPostItemForDelete="handleDeletePostItem"
        />
    </div>

    <ToastNotification
        :show="showNotification"
        @close="closeNotification"
        :type="status && status.success ? 'success' : 'error'"
    >
        <template #content>
            <template v-if="status">{{
                status.success || status.error
            }}</template>
            <template v-else>
                <p v-for="value in errors">
                    {{ value }}
                </p>
            </template>
        </template>
    </ToastNotification>

    <Modal :show="postItemEditing" @close="closeModal">
        <div class="p-4 text-gray-900 dark:text-gray-100 space-y-3">
            <div
                class="flex justify-between items-center border-b border-gray-200 dark:border-gray-600 pb-3"
            >
                <h2 class="text-xl font-bold">Edit Post</h2>
                <div
                    @click="postItemEditing = false"
                    class="bg-gray-200 dark:bg-gray-700 hover:bg-opacity-60 dark:hover:bg-opacity-80 p-2 rounded-full transition ease-in-out duration-150"
                >
                    <XMarkIcon class="icon-18" />
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a :href="route('profile.index', postItem.user.username)">
                    <img
                        :src="
                            postItem.user.avatar_url ??
                            'https://xsgames.co/randomusers/assets/avatars/male/72.jpg'
                        "
                        alt="Avatar Profile"
                        class="w-[40px] rounded-full hover:ring-2 hover:ring-indigo-500 hover:ring-offset-2 transition ease-in-out duration-150 dark:hover:ring-offset-gray-800"
                    />
                </a>
                <div>
                    <h4 class="font-bold">
                        <a
                            :href="
                                route('profile.index', postItem.user.username)
                            "
                            class="hover:underline decoration-indigo-500 transition ease-in-out duration-150"
                        >
                            {{ postItem.user.name }}
                        </a>
                        <template v-if="postItem.group">
                            >
                            <a
                                href="javascript:void(0)"
                                class="hover:underline decoration-indigo-500 transition ease-in-out duration-150"
                            >
                                {{ postItem.group.name }}
                            </a>
                        </template>
                    </h4>
                </div>
            </div>

            <div>
                <InputTextArea
                    v-model="updatePostItemForm.body"
                    placeholder="Update post here..."
                    class="min-h-[100px]"
                />
            </div>

            <div class="flex">
                <PrimaryButton
                    @click="handleUpdatePostItem"
                    class="w-full justify-center"
                >
                    Save changes
                </PrimaryButton>
            </div>
        </div>
    </Modal>
</template>

<style scoped></style>

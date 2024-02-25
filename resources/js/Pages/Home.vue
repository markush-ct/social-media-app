<script setup>
import { Head, Link } from "@inertiajs/vue3";
import GroupList from "@/Components/App/GroupList.vue";
import FollowingList from "@/Components/App/FollowingList.vue";
import CreatePost from "@/Components/App/CreatePost.vue";
import PostList from "@/Components/App/PostList.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps({
    posts: Object,
    status: String,
    errors: Object,
});
</script>

<template>
    <Head title="PinoyBook" />

    <AuthenticatedLayout>
        <div
            class="h-full bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100"
        >
            <div class="lg:grid lg:grid-cols-12 lg:gap-12">
                <div
                    class="lg:col-span-3 h-[calc(100vh-58px)] top-[58px] px-3 sticky hidden lg:block overflow-auto"
                >
                    <GroupList />
                </div>
                <div class="lg:col-span-6 space-y-3 py-3 lg:py-6">
                    <CreatePost :status="status" :errors="errors" />
                    <PostList :posts="posts.data" />
                </div>
                <div
                    class="lg:col-span-3 h-[calc(100vh-58px)] top-[58px] px-3 sticky hidden lg:block overflow-auto"
                >
                    <FollowingList />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
/* Webkit (Safari/Chrome) */
::-webkit-scrollbar {
    width: 8px;
}
::-webkit-scrollbar-track {
    @apply bg-gray-100 dark:bg-gray-900;
}
::-webkit-scrollbar-thumb {
    @apply bg-gray-300 dark:bg-gray-800 rounded-full;
}
::-webkit-scrollbar-thumb:hover {
    @apply bg-gray-500 dark:bg-gray-700;
}
</style>

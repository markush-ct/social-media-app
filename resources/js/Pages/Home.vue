<script setup>
import { Head, Link } from "@inertiajs/vue3";
import GroupList from "@/Components/App/GroupList.vue";
import FollowingList from "@/Components/App/FollowingList.vue";
import CreatePost from "@/Components/App/CreatePost.vue";
import PostList from "@/Components/App/PostList.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps({});
</script>

<template>
    <Head title="PinoyBook" />

    <AuthenticatedLayout>
        <div
            class="max-w-7xl mx-auto min-h-screen bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100"
        >
            <div class="grid lg:grid-cols-12 gap-3 min-h-screen p-3">
                <div
                    class="lg:col-span-3 bg-white dark:bg-gray-800 py-6 px-3 shadow rounded-md"
                >
                    <GroupList />
                </div>
                <div class="lg:col-span-6 order-3 lg:order-2 space-y-3">
                    <CreatePost />
                    <PostList />
                </div>
                <div
                    class="lg:col-span-3 lg:order-3 bg-white dark:bg-gray-800 py-6 px-3 shadow rounded-md"
                >
                    <FollowingList />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style></style>

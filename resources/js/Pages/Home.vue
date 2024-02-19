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
            class="h-full bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100"
        >
            <div class="lg:grid lg:grid-cols-12 lg:gap-12">
                <div
                    class="lg:col-span-3 h-[calc(100vh-58px)] top-[58px] py-6 px-3 shadow sticky hidden lg:block overflow-auto"
                >
                    <GroupList />
                </div>
                <div class="lg:col-span-6 space-y-3 py-3 lg:py-6">
                    <CreatePost />
                    <PostList />
                </div>
                <div
                    class="lg:col-span-3 h-[calc(100vh-58px)] top-[58px] py-6 px-3 shadow sticky hidden lg:block overflow-auto"
                >
                    <FollowingList />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style></style>

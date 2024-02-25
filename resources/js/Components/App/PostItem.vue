<script setup>
import { ref } from "vue";
import {
    HandThumbUpIcon,
    ChatBubbleBottomCenterIcon,
    PaperClipIcon,
    ArrowDownTrayIcon,
} from "@heroicons/vue/24/solid";

defineProps({ post: Object });

const isOpen = ref(false);

function isImage(attachment) {
    const mime = attachment.mime.split("/");
    return mime[0].toLowerCase() === "image";
}
</script>

<template>
    <div
        class="bg-white dark:bg-gray-800 px-4 pt-4 pb-1 shadow rounded-md space-y-3"
    >
        <div class="flex items-center gap-3">
            <a :href="route('profile.index', post.user.username)">
                <img
                    :src="
                        post.user.avatar_url ??
                        'https://xsgames.co/randomusers/assets/avatars/male/72.jpg'
                    "
                    alt="Avatar Profile"
                    class="w-[40px] rounded-full hover:ring-2 hover:ring-indigo-500 hover:ring-offset-2 transition ease-in-out duration-150 dark:hover:ring-offset-gray-800"
                />
            </a>
            <div>
                <h4 class="font-bold">
                    <a
                        :href="route('profile.index', post.user.username)"
                        class="hover:underline decoration-indigo-500 transition ease-in-out duration-150"
                    >
                        {{ post.user.name }}
                    </a>
                    <template v-if="post.group">
                        >
                        <a
                            href="javascript:void(0)"
                            class="hover:underline decoration-indigo-500 transition ease-in-out duration-150"
                        >
                            {{ post.group.name }}
                        </a>
                    </template>
                </h4>
                <p class="text-xs text-gray-600 dark:text-gray-400">
                    {{ post.created_at }}
                </p>
            </div>
        </div>

        <div v-html="isOpen ? post.body : post.body.substring(0, 100)"></div>
        <div v-if="post.body.length > 100" class="text-right">
            <a
                href="javascript:void(0)"
                @click="isOpen ? (isOpen = false) : (isOpen = true)"
            >
                {{ !isOpen ? "See more" : "See less" }}
            </a>
        </div>

        <div
            v-if="post.attachments.length > 0"
            class="grid grid-cols-2 lg:grid-cols-3 gap-3"
        >
            <div
                v-for="attachment of post.attachments"
                class="group aspect-square object-cover relative hover:ring-2 hover:ring-indigo-500 hover:ring-offset-2 transition ease-in-out duration-150 dark:hover:ring-offset-gray-800 rounded-md"
            >
                <!-- Download Button -->
                <div
                    class="absolute right-3 top-3 aspect-square p-2 bg-gray-100 dark:bg-gray-900 rounded-md cursor-pointer group-hover:opacity-100 opacity-0 transition-all ease-in-out duration-150 shadow-md"
                >
                    <ArrowDownTrayIcon class="w-[18px]" />
                </div>
                <img
                    v-if="isImage(attachment)"
                    :src="attachment.url"
                    alt="Attachment"
                    class="rounded-md"
                />
                <div
                    v-else
                    class="bg-gray-200 dark:bg-gray-700 h-full rounded-md flex items-center justify-center flex-col gap-3"
                >
                    <PaperClipIcon class="w-[48px]" />
                    <small>{{ attachment.name }}</small>
                </div>
            </div>
        </div>

        <!-- <hr class="h-px bg-gray-200 border-0 dark:bg-gray-600" /> -->

        <div
            class="flex text-sm pt-1 border-t border-gray-200 dark:border-gray-600"
        >
            <div
                class="flex items-center justify-center w-full gap-3 hover:bg-gray-200 dark:hover:bg-gray-700 cursor-pointer py-1 rounded-md"
            >
                <HandThumbUpIcon class="w-[18px]" />
                Like
            </div>
            <div
                class="flex items-center justify-center w-full gap-3 hover:bg-gray-200 dark:hover:bg-gray-700 cursor-pointer py-2 rounded-md"
            >
                <ChatBubbleBottomCenterIcon class="w-[18px]" />
                Comments
            </div>
        </div>
    </div>
</template>

<style scoped></style>

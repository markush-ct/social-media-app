<script setup>
import { ref } from "vue";

defineProps({ post: Object });

const isOpen = ref(false);

function isImage(attachment) {
    const mime = attachment.mime.split("/");
    return mime[0].toLowerCase() === "image";
}
</script>

<template>
    <div class="bg-white dark:bg-gray-800 p-3 shadow rounded-md space-y-3">
        <div class="flex items-center gap-3">
            <a href="javascript:void(0)">
                <img
                    :src="post.user.avatar"
                    alt="Avatar Profile"
                    class="w-[40px] rounded-full hover:ring-2 hover:ring-indigo-500 hover:ring-offset-2 transition ease-in-out duration-150 dark:hover:ring-offset-gray-800"
                />
            </a>
            <div>
                <h4 class="font-bold">
                    <a
                        href="javascript:void(0)"
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
        <div class="text-right">
            <a
                href="javascript:void(0)"
                @click="isOpen ? (isOpen = false) : (isOpen = true)"
            >
                {{ !isOpen ? "See more" : "See less" }}
            </a>
        </div>

        <div
            v-if="post.attachments"
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
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                        className="w-6 h-6"
                        class="w-[16px]"
                    >
                        <path
                            fillRule="evenodd"
                            d="M12 2.25a.75.75 0 0 1 .75.75v11.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0l-4.5-4.5a.75.75 0 1 1 1.06-1.06l3.22 3.22V3a.75.75 0 0 1 .75-.75Zm-9 13.5a.75.75 0 0 1 .75.75v2.25a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V16.5a.75.75 0 0 1 1.5 0v2.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V16.5a.75.75 0 0 1 .75-.75Z"
                            clipRule="evenodd"
                        />
                    </svg>
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
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                        className="w-6 h-6"
                        class="w-[48px]"
                    >
                        <path
                            fillRule="evenodd"
                            d="M18.97 3.659a2.25 2.25 0 0 0-3.182 0l-10.94 10.94a3.75 3.75 0 1 0 5.304 5.303l7.693-7.693a.75.75 0 0 1 1.06 1.06l-7.693 7.693a5.25 5.25 0 1 1-7.424-7.424l10.939-10.94a3.75 3.75 0 1 1 5.303 5.304L9.097 18.835l-.008.008-.007.007-.002.002-.003.002A2.25 2.25 0 0 1 5.91 15.66l7.81-7.81a.75.75 0 0 1 1.061 1.06l-7.81 7.81a.75.75 0 0 0 1.054 1.068L18.97 6.84a2.25 2.25 0 0 0 0-3.182Z"
                            clipRule="evenodd"
                        />
                    </svg>
                    <small>{{ attachment.name }}</small>
                </div>
            </div>
        </div>

        <hr class="h-px bg-gray-200 border-0 dark:bg-gray-600" />
        <div class="flex gap-3">
            <div
                class="flex items-center justify-center w-full gap-3 hover:bg-gray-200 dark:hover:bg-gray-700 cursor-pointer p-2 rounded-md"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                    className="w-6 h-6"
                    class="w-[24px]"
                >
                    <path
                        d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75A.75.75 0 0 1 15 2a2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777ZM2.331 10.727a11.969 11.969 0 0 0-.831 4.398 12 12 0 0 0 .52 3.507C2.28 19.482 3.105 20 3.994 20H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 0 1-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227Z"
                    />
                </svg>
                Like
            </div>
            <div
                class="flex items-center justify-center w-full gap-3 hover:bg-gray-200 dark:hover:bg-gray-700 cursor-pointer p-2 rounded-md"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                    className="w-6 h-6"
                    class="w-[24px]"
                >
                    <path
                        fillRule="evenodd"
                        d="M4.848 2.771A49.144 49.144 0 0 1 12 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97a48.901 48.901 0 0 1-3.476.383.39.39 0 0 0-.297.17l-2.755 4.133a.75.75 0 0 1-1.248 0l-2.755-4.133a.39.39 0 0 0-.297-.17 48.9 48.9 0 0 1-3.476-.384c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97ZM6.75 8.25a.75.75 0 0 1 .75-.75h9a.75.75 0 0 1 0 1.5h-9a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H7.5Z"
                        clipRule="evenodd"
                    />
                </svg>
                Comments
            </div>
        </div>
        <hr class="h-px bg-gray-200 border-0 dark:bg-gray-600" />
    </div>
</template>

<style scoped></style>

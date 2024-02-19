<script setup>
import PostItem from "./PostItem.vue";

const post1 = {
    user: {
        id: 1,
        avatar: "https://xsgames.co/randomusers/assets/avatars/male/74.jpg",
        name: "John Smith",
    },
    group: null,
    attachments: [
        {
            id: 1,
            name: "test1.png",
            url: "https://picsum.photos/1000",
            mime: "image/png",
        },
        {
            id: 2,
            name: "test2.png",
            url: "https://picsum.photos/1000",
            mime: "image/png",
        },
        {
            id: 3,
            name: "test3.png",
            url: "https://picsum.photos/1000",
            mime: "image/png",
        },
        {
            id: 4,
            name: "word.docx",
            url: "#",
            mime: "application/msword",
        },
    ],
    body: `<p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque
            voluptas accusamus voluptate in ut velit praesentium impedit magni
            similique modi nisi, dicta optio quae pariatur error sapiente! A, ad
            dignissimos!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque
            voluptas accusamus voluptate in ut velit praesentium impedit magni
            similique modi nisi, dicta optio quae pariatur error sapiente! A, ad
            dignissimos!
        </p>`,
    created_at: "2024-02-18 20:34",
};
const post2 = {
    user: {
        id: 2,
        avatar: "https://xsgames.co/randomusers/assets/avatars/male/72.jpg",
        name: "Santo Stuer",
    },
    group: {
        id: 1,
        name: "Laravel Developers",
    },
    attachments: [
        {
            id: 1,
            name: "test1.png",
            url: "https://picsum.photos/1000",
            mime: "image/png",
        },
    ],
    body: `<p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque
            voluptas accusamus voluptate in ut velit praesentium impedit magni
            similique modi nisi, dicta optio quae pariatur error sapiente! A, ad
            dignissimos!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque
            voluptas accusamus voluptate in ut velit praesentium impedit magni
            similique modi nisi, dicta optio quae pariatur error sapiente! A, ad
            dignissimos!
        </p>`,
    created_at: "2024-02-18 20:34",
};
</script>

<template>
    <PostItem :post="post1" />
    <PostItem :post="post2" />
</template>

<style scoped></style>

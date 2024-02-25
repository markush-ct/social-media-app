<script setup>
import PostItem from "./PostItem.vue";

const props = defineProps({
    posts: Object,
});
</script>

<template>
    <PostItem v-for="post of posts" :post="post" :key="post.id" />
</template>

<style scoped></style>

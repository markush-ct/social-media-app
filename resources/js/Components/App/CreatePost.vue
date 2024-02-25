<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ref } from "vue";
import { TransitionRoot } from "@headlessui/vue";
import { useForm } from "@inertiajs/vue3";
import InputTextArea from "@/Components/InputTextArea.vue";
import ToastNotification from "../ToastNotification.vue";

defineProps({
    status: String,
    errors: Object,
});

const postCreating = ref(false);
const showNotification = ref(false);

const postForm = useForm({
    body: null,
});

const handlePost = () => {
    postForm.post(route("posts.store"), {
        onSuccess: () => {
            postForm.reset();
            showNotification.value = true;
            setTimeout(() => (showNotification.value = false), 5000);
        },
        onError: () => {
            showNotification.value = true;
            setTimeout(() => (showNotification.value = false), 5000);
        },
    });
};

const closeNotification = () => {
    showNotification.value = false;
};
</script>

<template>
    <ToastNotification
        :show="showNotification"
        @close="closeNotification"
        :type="status ? 'status' : 'error'"
    >
        <template #content>
            <template v-if="status">{{ status }}</template>
            <template v-else>
                <p v-for="value in errors">
                    {{ value }}
                </p>
            </template>
        </template>
    </ToastNotification>

    <div class="bg-white dark:bg-gray-800 p-3 shadow rounded-md space-y-3">
        <InputTextArea
            v-model="postForm.body"
            @click="postCreating = true"
            placeholder="Create new post here..."
        />

        <TransitionRoot
            :show="postCreating"
            enter="transition-opacity duration-150"
            enter-from="opacity-0"
            enter-to="opacity-100"
            leave="transition-opacity duration-150"
            leave-from="opacity-100"
            leave-to="opacity-0"
        >
            <div class="flex gap-3">
                <input
                    class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
                    type="file"
                    id="formFile"
                    accept="image/png, image/jpeg"
                />

                <PrimaryButton @click="handlePost">Submit</PrimaryButton>
            </div>
        </TransitionRoot>
    </div>
</template>

<style scoped></style>

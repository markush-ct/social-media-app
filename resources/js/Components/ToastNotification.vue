<script setup>
import { computed } from "vue";
import { XMarkIcon } from "@heroicons/vue/24/solid";

const props = defineProps({
    type: {
        type: String,
        default: "success",
    },
    show: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["close"]);

const toastType = computed(() => {
    return {
        success:
            "fixed z-50 top-20 lg:right-3 -right-1/2 transform -translate-x-1/2 lg:transform-none p-3 w-full lg:max-w-[30%] bg-green-800 rounded-md flex gap-2 items-start justify-between bg-opacity-80 outline outline-1 outline-green-600",
        error: "fixed z-50 top-20 lg:right-3 -right-1/2 transform -translate-x-1/2 lg:transform-none p-3 w-full lg:max-w-[30%] bg-red-800 rounded-md flex gap-2 items-start justify-between bg-opacity-80 outline outline-1 outline-red-600",
    }[props.type];
});

const close = () => {
    emit("close");
};
</script>

<template>
    <Teleport to="body">
        <div v-show="show" :class="toastType">
            <div><slot name="content" /></div>
            <div>
                <XMarkIcon class="w-[24px]" @click="close" />
            </div>
        </div>
    </Teleport>
</template>

<style scoped></style>

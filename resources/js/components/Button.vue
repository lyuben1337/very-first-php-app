<template>
    <button :class="className">
        <slot></slot>
    </button>
</template>

<script setup lang="ts">
import clsx from "clsx";

const props = defineProps<{ variant?: keyof typeof variants }>();

const variants = {
    default: "bg-blue-500 hover:bg-blue-600",
    danger: "bg-red-500 hover:bg-red-600",
    secondary: "bg-gray-300 hover:bg-gray-400",
};

const className = clsx(
    "px-4 py-2 rounded-md text-white font-medium transition",
    variants[props.variant || "default"],
);
</script>

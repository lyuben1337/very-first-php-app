<template>
    <li class="border p-4 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold">{{ post.title }}</h3>
        <p class="text-gray-600">{{ post.body }}</p>
        <div class="mt-4 flex gap-2 justify-end">
            <Button @click="$emit('edit', post)">Edit</Button>
            <Button variant="danger" @click="handleDelete"> Delete </Button>
        </div>
    </li>
</template>

<script setup lang="ts">
import { defineProps } from "vue";
import { usePostStore } from "@/store/postStore";
import Button from "@/components/Button.vue";
import { useToast } from "vue-toastification";

const props = defineProps<{
    post: { id: number; title: string; body: string };
}>();
const emit = defineEmits(["edit"]);

const postStore = usePostStore();
const toast = useToast();

const handleDelete = async () => {
    await postStore.deletePost(props.post.id);
    toast.info("Post deleted!");
};
</script>

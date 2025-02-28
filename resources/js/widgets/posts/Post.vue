<template>
    <li class="border p-4 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold">{{ post.title }}</h3>
        <p class="text-gray-600">{{ post.body }}</p>
        <div class="flex items-center justify-between gap-2 mt-4">
            <div class="flex gap-2 w-fit">
                <p class="text-gray-300">{{ formatDate(post.created_at) }}</p>
                <p
                    v-if="post.created_at !== post.updated_at"
                    class="text-gray-300 italic"
                >
                    edited
                </p>
            </div>
            <div class="flex gap-2 w-fit">
                <Button @click="$emit('edit', post)">Edit</Button>
                <Button variant="danger" @click="handleDelete">Delete</Button>
            </div>
        </div>
    </li>
</template>

<script setup lang="ts">
import { defineProps } from "vue";
import { usePostStore } from "@/store/postStore";
import Button from "@/components/Button.vue";
import { useToast } from "vue-toastification";
import { Post } from "@/models/Post";
import { formatDate } from "@/utils/dateUtils";

const props = defineProps<{
    post: Post;
}>();

defineEmits(["edit"]);

const postStore = usePostStore();
const toast = useToast();

const handleDelete = async () => {
    await postStore.deletePost(props.post.id);
    toast.info("Post deleted!");
};
</script>

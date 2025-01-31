<template>
    <Modal v-model="visible" title="Edit the post">
        <PostForm
            :post="selectedPost"
            @close="handleClose"
            @save="handleSave"
        />
    </Modal>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { usePostStore } from "@/store/postStore";
import { Modal } from "@kouts/vue-modal";
import PostForm from "@/widgets/posts/PostForm.vue";
import { Post } from "@/models/Post";
import { useToast } from "vue-toastification";

const visible = ref(false);
const selectedPost = ref<Post | null>(null);

const postStore = usePostStore();
const toast = useToast();
function handleSave(postData: { id: number; title: string; body: string }) {
    postStore
        .updatePost(postData.id, {
            title: postData.title,
            body: postData.body,
        })
        .then(() => {
            visible.value = false;
            toast.success("Post updated successfully!");
        });
}

function handleClose() {
    visible.value = false;
}

function openModal(post: Post) {
    selectedPost.value = { ...post };
    visible.value = true;
}

defineExpose({
    openModal,
});
</script>

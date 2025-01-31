<template>
    <Modal v-model="visible" title="Create a new post">
        <PostForm @close="handleClose" @save="handleSave" />
    </Modal>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { usePostStore } from "@/store/postStore";
import { Modal } from "@kouts/vue-modal";
import PostForm from "@/widgets/posts/PostForm.vue";
import { PostDto } from "@/dtos/PostDto";
import { useToast } from "vue-toastification";

const visible = ref(false);
const postStore = usePostStore();
const toast = useToast();

function handleSave(postData: PostDto) {
    postStore.createPost(postData).then(() => {
        visible.value = false;
        toast.success("Post created successfully!");
    });
}

function handleClose() {
    visible.value = false;
}
defineExpose({
    visible,
});
</script>

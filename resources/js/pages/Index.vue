<template>
    <div class="max-w-3xl mx-auto p-6 flex flex-col min-h-[100vh]">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold [word-spacing:0.5rem]">
                {{ postStore.postsPage.total }} Posts
            </h2>
            <Button @click="openCreateModal">Create</Button>
        </div>

        <div class="flex-grow">
            <ul class="space-y-4">
                <Post
                    v-for="post in postStore.postsPage.data"
                    :key="post.id"
                    :post="post"
                    @edit="openEditModal"
                />
            </ul>
        </div>

        <div class="mt-auto pt-6">
            <Paginate
                v-model="currentPage"
                :page-count="postStore.postsPage.last_page"
                :click-handler="paginationCallback"
                :prev-text="'Prev'"
                :next-text="'Next'"
                :container-class="'pagination'"
            />
        </div>
    </div>

    <CreatePostModal ref="createModalRef" />
    <EditPostModal ref="editModalRef" />
</template>

<script setup lang="ts">
import { onMounted, ref } from "vue";
import { usePostStore } from "@/store/postStore";
import Button from "@/components/Button.vue";
import Post from "@/widgets/posts/Post.vue";
import { Post as PostModel } from "@/models/Post";
import CreatePostModal from "@/widgets/posts/CreatePostModal.vue";
import EditPostModal from "@/widgets/posts/EditPostModal.vue";
import Paginate from "vuejs-paginate-next";
import { useRoute, useRouter } from "vue-router";

const postStore = usePostStore();
const route = useRoute();
const router = useRouter();

const createModalRef = ref<InstanceType<typeof CreatePostModal>>();
const editModalRef = ref<InstanceType<typeof EditPostModal>>();
const currentPage = ref(Number(route.query.page) || 1);

onMounted(() => postStore.fetchPosts(currentPage.value));

function paginationCallback(pageNum: number) {
    router.push({ query: { ...route.query, page: pageNum } });
    postStore.fetchPosts(pageNum);
}

function openCreateModal() {
    if (createModalRef.value) {
        createModalRef.value.visible = true;
    }
}
function openEditModal(post: PostModel) {
    editModalRef.value?.openModal(post);
}
</script>

import { defineStore } from "pinia";
import axios from "axios";
import type { Post } from "@/models/Post";
import type { PostDto } from "@/dtos/PostDto";
import type { PaginatedResponse } from "@/abstractions/PaginatedResponse";

export const usePostStore = defineStore("postStore", {
    state: () => ({
        postsPage: {} as PaginatedResponse<Post>,
    }),
    actions: {
        async fetchPosts(page = 1, perPage = 4) {
            const { data } = await axios.get<PaginatedResponse<Post>>(
                `/api/posts?page=${page}&per_page=${perPage}`,
            );
            this.postsPage = data;
        },
        async createPost(post: PostDto) {
            await axios.post("/api/posts", post);
            this.fetchPosts(this.postsPage.current_page);
        },
        async updatePost(id: number, post: PostDto) {
            await axios.put(`/api/posts/${id}`, post);
            this.fetchPosts(this.postsPage.current_page);
        },
        async deletePost(id: number) {
            await axios.delete(`/api/posts/${id}`);
            this.fetchPosts(this.postsPage.current_page);
        },
    },
});

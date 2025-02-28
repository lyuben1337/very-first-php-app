<template>
    <input
        v-model="formData.title"
        class="w-full p-2 border rounded mb-2"
        placeholder="Title"
    />
    <textarea
        v-model="formData.body"
        class="w-full p-2 border rounded mb-4 resize-none overflow-y-auto h-[100px]"
        placeholder="Body"
    ></textarea>

    <div class="flex justify-end gap-2">
        <Button variant="secondary" @click="$emit('close')">Cancel</Button>
        <Button @click="handleSubmit">Save</Button>
    </div>
</template>

<script setup lang="ts">
import { defineProps, defineEmits, reactive } from "vue";
import Button from "@/components/Button.vue";

const props = defineProps<{
    post?: { id: number; title: string; body: string } | null;
}>();

const emit = defineEmits(["close", "save"]);

const formData = reactive({
    title: props.post?.title || "",
    body: props.post?.body || "",
});

function handleSubmit() {
    emit("save", { ...formData, id: props.post?.id });
}
</script>

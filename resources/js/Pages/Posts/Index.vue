<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import List from '@/Components/Post/List.vue'
import { ref } from 'vue'

const props = defineProps({
    posts: Object
})

const query = ref({})

const getPosts = (page) => {
    if (page) {
        query.value.page = page
    }
    router.visit(route('posts.list', query.value))
}

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Posts</h2>
        </template>
        <Link :href="route('posts.create')">Create Post</Link>
        <hr class="mb-2">


        <List :posts="posts" :handle-page-change="page => getPosts(page)" />



    </AuthenticatedLayout>
</template>

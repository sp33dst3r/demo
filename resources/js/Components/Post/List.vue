<script setup>
import Pagination from '@/Components/Pagination.vue';
import { Link } from '@inertiajs/vue3';


const props = defineProps({
    posts: Object,
    handlePageChange: {
        type: Function,
        required: false
    }
})

const changePage = (page) => {
    props.handlePageChange(page);
}
</script>


<template>
    <h2>List of Posts</h2>
    <div v-for="post in posts.data">
        {{ post.title }}
        <Link v-if="post.can.update" :href="route('posts.edit', post.id)">

        <i class="fa-solid fa-pen-to-square"></i>
        </Link>
        <Link v-if="post.can.delete" :href="route('posts.delete', post.id)">
        <i class="fa-solid fa-xmark"></i>
        </Link>
    </div>



    <Pagination v-if="posts.meta.total" @page-changed="page => changePage(page)" :currentPage="posts.meta.current_page"
        :total="posts.meta.total" :perPage="posts.meta.per_page" :lastPage="posts.meta.last_page" />
</template>
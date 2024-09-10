<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextArea from '@/Components/TextArea.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';



const props = defineProps({ errors: Object, post: Object });

const form = useForm({
    id: props.post?.id ?? null,
    title: props.post?.title ?? null,
    content: props.post?.content ?? null,
});


const submit = () => {
    router.post(route('posts.store'), form)
}
</script>

<template>

    <Head title="Create Post" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Post</h2>
        </template>

        <div class="py-12">
            <form action="" @submit.prevent="submit">
                <div class="row">
                    <InputLabel value="Title" />
                    <TextInput v-model="form.title" />
                    <div v-if="errors.title">{{ errors.title }}</div>
                </div>
                <div class="row">
                    <InputLabel value="Content" />
                    <TextArea v-model="form.content" />
                    <div v-if="errors.content">{{ errors.content }}</div>
                </div>
                <div class="row">
                    <primary-button>Submit</primary-button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
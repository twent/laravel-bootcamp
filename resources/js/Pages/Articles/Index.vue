<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Article from '@/Components/Article.vue';
import { useForm, Head } from '@inertiajs/inertia-vue3';
import GuestLayout from "@/Layouts/GuestLayout.vue";

defineProps(['articles']);

const form = useForm({
    title: '',
    text: '',
});

</script>

<template>
    <Head title="Articles" />

    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('dashboard.articles.store'), { onSuccess: () => form.reset() })">
                <div>
                    <InputLabel for="title" value="Title" />
                    <TextInput id="title" type="text" placeholder="Title" class="mt-1 block w-full" v-model="form.title" required autofocus autocomplete="false" />
                    <InputError :message="form.errors.title" class="mt-2" />
                </div>

                <div class="mt-4">
                    <InputLabel for="text" value="Text" class="mb-1" />
                    <textarea
                        id="text"
                        v-model="form.text"
                        placeholder="What's on your mind?"
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    ></textarea>
                    <InputError :message="form.errors.text" class="mt-2" />
                </div>

                <PrimaryButton class="mt-4">Add Article</PrimaryButton>
            </form>

            <div class="mt-6 bg-white shadow-md rounded-lg divide-y">
                <Article
                    v-for="article in articles"
                    :key="article.id"
                    :article="article"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

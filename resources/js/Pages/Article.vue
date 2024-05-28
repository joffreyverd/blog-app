<script setup>
import Image from '@/Components/Image/Image.vue';
import PageTitle from '@/Components/PageTitle/PageTitle.vue';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Bookmark, Pencil, SquareUserRound, Trash2Icon } from 'lucide-vue-next';

const props = defineProps({
    article: {
        type: Object,
        required: true,
    },
});

const form = useForm({});

const deleteArticle = () => {
    form.delete(route('articles.destroy', { article: props.article.id }), {
        onSuccess: () => {
            form.reset();
        }
    });
};

</script>

<template>

    <Head title="Article" />
    <DefaultLayout>
        <header class="flex justify-between">
            <PageTitle :title="article.title" />
            <div class="flex justify-end gap-4 mb-12">
                <span class="flex bg-green-100 text-green-800 text-l font-medium px-2.5 py-0.5 rounded">
                    <Bookmark class="w-4 mr-2" />
                    {{ article.category.name }}
                </span>
                <span class="flex bg-blue-100 text-blue-800 text-l font-medium px-2.5 py-0.5 rounded">
                    <SquareUserRound class="w-4 mr-2" />
                    {{ article.user.name }}
                </span>
            </div>
        </header>
        <main class="flex gap-12">
            <div class="w-3/6">
                <Image :image_path="article.image_path" class="max-h-120 m-auto rounded-md mb-12" />
            </div>

            <div class="w-3/6">
                <p class="text-justify mb-12">{{ article.content }}</p>
                <div v-if="$page?.props?.auth?.user?.id === article.user.id" class="flex justify-end space-x-4">
                    <Link :href="route('articles.create', { article: article.id })">
                    <button type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <Pencil class="w-4 mr-2" />
                        Editer
                    </button>
                    </Link>
                    <form @submit.prevent="deleteArticle">
                        <button type="submit"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <Trash2Icon class="w-4 mr-2" />
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </DefaultLayout>
</template>

<script setup>
import FileUpload from '@/Components/FileUpload/FileUpload.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PageTitle from '@/Components/PageTitle/PageTitle.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { Send } from 'lucide-vue-next';

const props = defineProps({
    categories: {
        type: Array,
    },
    article: {
        type: Object,
        default: null,
    },
});

const form = useForm({
    title: props.article?.title || '',
    content: props.article?.content || '',
    category_id: props.article?.category_id || '',
    image: null,
    image_path: props.article?.image_path || '',
});

const submit = () => {
    if (props.article) {
        form.post(route('articles.update', { article: props.article.id }), {
            onSuccess: () => form.reset('content', 'title', 'category_id', 'image_path', 'image'),
        });
        return;
    }
    form.post(route('articles.create'), {
        onSuccess: () => form.reset('content', 'title', 'category_id', 'image_path', 'image'),
    });
};
</script>

<template>
    <DefaultLayout>

        <Head :title="article ? 'Editer un article' : 'Ecrire un article'" />

        <header>
            <PageTitle :title="article ? 'Editer un article' : 'Ecrire un article'" />
        </header>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="title" value="Title" />
                <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus />
                <InputError class="mt-2" :message="form.errors.title" />
            </div>

            <div class="mt-4">
                <InputLabel for="content" value="Contenu" />
                <textarea id="content" type="text" class="mt-1 block w-full min-h-60" v-model="form.content" required />
                <InputError class="mt-2" :message="form.errors.content" />
            </div>

            <div class="mt-4">
                <InputLabel for="category_id" value="Catégorie" />
                <select class="input-frame" v-if="categories" v-model="form.category_id" name="category_id"
                    id="category_id" required>
                    <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}
                    </option>
                </select>
                <InputError class="mt-2" :message="form.errors.category_id" />
            </div>

            <div class="mt-4">
                <InputLabel for="image" value="Image" />
                <FileUpload v-model="form.image" name="image" id="image" />
                <InputError class="mt-2" :message="form.errors.image" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    <Send class="w-4 mr-2" />
                    {{ article ? 'Editer' : 'Publier' }}
                </PrimaryButton>
            </div>
        </form>
    </DefaultLayout>
</template>

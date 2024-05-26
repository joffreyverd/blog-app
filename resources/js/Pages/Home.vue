<script setup>
import PageTitle from '@/Components/PageTitle/PageTitle.vue';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useIntersectionObserver } from '@vueuse/core';
import axios from 'axios';
import { ref, toRaw } from 'vue';
import Card from '../Components/Card/Card.vue';

const props = defineProps({
    articles: Object
});
const last = ref(null);

const { stop } = useIntersectionObserver(last, ([{ isIntersecting }]) => {
    console.log(isIntersecting);
    if (!isIntersecting) {
        return;
    }
    axios.get(`${props.articles.meta.path}?cursor=${props.articles.meta.next_cursor}`)
        .then((response) => {
            props.articles.data = [...toRaw(props.articles.data), ...response.data.data];
            props.articles.meta = response.data.meta;
            if (!response.data.meta.next_cursor) {
                stop();
            }
    });
});

</script>

<template>
        <Head title="Home" />
        <DefaultLayout>
            <header>
                <PageTitle title="Tous les articles" />
            </header>

            <main class="grid gap-12  grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                <Card
                    v-for="article in articles.data"
                    :key="article.id"
                    :id="article.id"
                    :title="article.title"
                    :content="article.content"
                    :image_path="article.image_path"
                />

                <!-- -translate-y-64 is triggered before the end of articles on the viewport to smoothly call new entries -->
                <div ref="last" class="-translate-y-64"></div>
            </main>
    </DefaultLayout>
</template>

<script setup>
import Image from '@/Components/Image/Image.vue';
import { Link } from '@inertiajs/vue3';

defineProps(['id', 'title', 'content', 'image_path']);
</script>

<template>
  <Link :href="route('articles.show', { article: id })" class="hover:scale-95 transition-all flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl h-64">
    <Image :image_path="image_path" class="object-cover h-full w-1/2 rounded-t-lg md:w-48 md:rounded-none md:rounded-s-lg"/>
    <div class="flex flex-col justify-between p-4 leading-normal">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white overflow-hidden truncate w-48">{{title}}</h5>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 text-justify">{{ `${content.substring(0,150)}...` }}</p>
    </div>
  </Link>
</template>

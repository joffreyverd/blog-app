<script setup>
const props = defineProps({
  image_path: {
    type: String,
    required: true,
  },
});

const defaultImagePath = '/storage/';
const image = props.image_path !== defaultImagePath ? props.image_path : `https://source.unsplash.com/random/?cat&random=${Math.random()}&w=240`;
</script>

<template>
    <img :src="image" alt="Image"/>
</template>

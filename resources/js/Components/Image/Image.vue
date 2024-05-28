<script setup>
const props = defineProps({
  image_path: {
    type: String,
    required: true,
  },
});

// `https://source.unsplash.com/random/?cat&random=${Math.random()}&w=240`
const defaultPics = [
  "https://images.unsplash.com/photo-1573865526739-10659fec78a5?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8Y2F0fGVufDB8fDB8fHww",
  "https://images.unsplash.com/photo-1592194996308-7b43878e84a6?q=80&w=3087&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
  "https://images.unsplash.com/photo-1574144611937-0df059b5ef3e?q=80&w=2955&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
  "https://images.unsplash.com/photo-1571566882372-1598d88abd90?q=80&w=3087&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
  "https://images.unsplash.com/photo-1548366086-7f1b76106622?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NTV8fGNhdHxlbnwwfHwwfHx8MA%3D%3D",
  "https://images.unsplash.com/photo-1607242792481-37f27e1d74e1?q=80&w=3087&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
  "https://images.unsplash.com/photo-1571988840298-3b5301d5109b?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTA2fHxjYXR8ZW58MHx8MHx8fDA%3D"
];
const randomPic = Math.floor(Math.random() * defaultPics.length);
const defaultImagePath = '/storage/';
const image = props.image_path !== defaultImagePath ? props.image_path : defaultPics[randomPic];
</script>

<template>
  <img :src="image" alt="Image" />
</template>

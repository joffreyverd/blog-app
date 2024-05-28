<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
  modelValue: File,
});

const emit = defineEmits(['update:modelValue']);
const imageUrl = ref(null);

const onFileChange = (event) => {
  const file = event.target.files[0];
  emit('update:modelValue', file);
  if (file) {
    const reader = new FileReader();
    reader.onload = (e) => {
      imageUrl.value = e.target.result;
    };
    reader.readAsDataURL(file);
  }
};

watch(() => props.modelValue, (newFile) => {
  if (!newFile) {
    imageUrl.value = null;
  }
});
</script>

<template>
  <div>
    <input type="file" @change="onFileChange" />
    <div v-if="imageUrl" class="mt-4">
      <img :src="imageUrl" alt="Image preview" class="max-w-40 rounded-md" />
    </div>
  </div>
</template>

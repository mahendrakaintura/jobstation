<template>
    <div class="about-container">
      <h1 class="text-center text-2xl font-bold">ジョブステーションとは</h1>
      <p class="mt-4 text-lg">{{ content }}</p>
    </div>
  </template>
  
  <script setup>
  // Props ko define karte hain jo controller se pass kiye jayenge
  const props = defineProps({
    content: String
  });
  </script>
  
  <style scoped>
  .about-container {
    padding: 20px;
    max-width: 800px;
    margin: 0 auto;
  }
  </style>
  
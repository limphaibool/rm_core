<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router';

</script>

<template>
  <div class="min-h-screen flex flex-col h-full">
    <header class="h-16 bg-cyan-600 text-white flex justify-between items-center p-4">
      <h1>Quality Ceramic</h1>
    </header>
    <main class="flex-grow flex flex-col bg-blue-200 h-full">
      <RouterView />
    </main>
  </div>
</template>

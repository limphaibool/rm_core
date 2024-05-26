<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router';

</script>

<template>
  <div>
    hello
    <nav>
      <RouterLink to="/">Home</RouterLink>
    </nav>
    <RouterView />
  </div>
</template>

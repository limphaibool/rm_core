<template>
    <div class="rounded-md bg-white p-7 border-surface-300 border">
        <div class="text-surface-800 text-3xl">
            {{ title ?? route.meta.title }}
        </div>
        <slot></slot>
    </div>
</template>

<script setup lang="ts">
import { useRoute } from 'vue-router';
const route = useRoute();
defineProps<{ title?: string }>();

</script>

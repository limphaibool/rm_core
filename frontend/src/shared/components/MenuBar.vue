<template>
    <div class="bg-white shadow-gray-400 p-3 w-72 mt-6 mb-5 ml-5 rounded-xl shadow-sm flex flex-col">
        <Menu :model="menus" class="border-0 text-xl" />
    </div>
</template>

<script setup lang="ts">
import { MenuItem } from 'primevue/menuitem';
import Menu from 'primevue/menu';

defineProps<{
    menus: MenuItem[]
}>();

</script>

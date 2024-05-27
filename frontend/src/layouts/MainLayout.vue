<script setup lang="ts">
import Button from 'primevue/button';
import Sidebar from 'primevue/sidebar';
import { ref } from 'vue';
const visible = ref(false);


</script>
<template>
    <div class="flex flex-col min-h-screen bg-gradient-to-br from-primary-400 to-primary-50">
        <Sidebar v-model:visible="visible" header="Sidebar">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat.</p>
        </Sidebar>
        <header class=" font-bold align-middle flex space-x-4 items-center p-6 ">
            <button
                class="border-2 text-secondary-700 border-secondary-400 hover:bg-secondary-800 hover:text-white transition-colors duration-300 px-2 py-1 rounded-md"
                @click="visible = !visible">
                <i class="pi pi-bars"></i>
            </button>
            <div class="text-secondary-900">
                QUALITY CERAMIC
            </div>
        </header>
        <div class="flex-grow flex ">
            <main class="flex-grow p-4">
                <RouterView />
            </main>
        </div>
    </div>
</template>
<template>
    <div class="flex flex-col min-h-screen bg-gradient-to-b from-50% from-secondary-950 to-sky-950">
        <header class=" text-primary-400 font-bold align-middle flex justify-between items-center p-6">
            QUALITY CERAMIC
        </header>
        <div class="flex-grow flex">
            <main class="flex-grow p-4">
                <RouterView />
            </main>
        </div>
    </div>
</template>
<script setup lang="ts">
</script>
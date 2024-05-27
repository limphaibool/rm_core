<script setup lang="ts">
</script>
<template>
    <div class="flex flex-col min-h-screen">
        <header
            class="h-16 bg-secondary-900 text-orange-100 font-bold align-middle flex justify-between items-center p-6">
            QUALITY CERAMIC
        </header>
        <div class="flex-grow flex">
            <main class="flex-grow p-4 bg-secondary-900">
                <RouterView />
            </main>
        </div>
    </div>
</template>
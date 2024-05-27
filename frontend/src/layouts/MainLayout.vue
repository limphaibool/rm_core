<script setup lang="ts">
</script>
<template>
    <div class="flex flex-col min-h-screen">
        <header class="h-16 bg-green-600 text-white align-middle flex justify-between items-center p-4">
            <div>
                QUALITY CERAMIC
            </div>
            <div class="flex space-x-3">
                <RouterLink to="/home">Home</RouterLink>
                <RouterLink to="/login">Logout</RouterLink>
            </div>
        </header>
        <div class="flex-grow flex">
            <div class="w-64 bg-cyan-800 p-4 text-white">
                <h2>module</h2>
                <h2>module</h2>
                <h2>module</h2>
            </div>
            <main class="bg-cyan-100 flex-grow p-4">
                <RouterView />
            </main>

        </div>
    </div>
</template>
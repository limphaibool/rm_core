<script setup lang="ts">


</script>
<template>
    <div class="flex flex-col min-h-screen bg-gradient-to-l from-primary-300 to-white  ">
        <header
            class="m-3 rounded-md bg-secondary-900 font-bold align-middle flex space-x-4 items-center p-6 shadow-xl">
            <div class="text-primary-200">
                QUALITY CERAMIC
            </div>
        </header>
        <div class="flex-grow flex ">
            <div class="bg-slate-800 text-white p-4 w-60 mb-3 ml-3 rounded-md shadow-md flex flex-col">
                <RouterLink to="/users" class="p-2 hover:bg-slate-600 rounded">Users</RouterLink>
                <RouterLink to="/roles" class="p-2 hover:bg-slate-600 rounded">Roles</RouterLink>
            </div>
            <main class="flex-grow p-4">
                <RouterView />
            </main>
        </div>
    </div>
</template>
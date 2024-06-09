<template>
    <header
        class="h-20 bg-white justify-between font-bold align-middle flex space-x-4 items-center p-6 shadow-gray-300 shadow-md">
        <div class="pl-5 text-secondary-700">
            QUALITY CERAMIC
        </div>
        <div class="space-x-2 pr-3">
            <Button icon="pi pi-user" class="text-primary-900 bg-white hover:bg-primary-800 hover:text-white" text
                aria-label="Profile" size="large" @click="() => router.push({ name: 'profile' })" />
            <Button icon="pi pi-sign-out" class="text-primary-900 bg-white hover:bg-primary-800 hover:text-white " text
                aria-label="Logout" size="large" @click="handleLogout" />
        </div>

    </header>
</template>
<script setup lang="ts">
import Button from 'primevue/button';
import axios from 'axios';
import { useRouter } from 'vue-router';
import { useAuthStore } from '../features/authentication/auth';

const router = useRouter();
const authStore = useAuthStore();

const handleLogout = async () => {
    await axios.post('/auth/logout');
    authStore.clearUser();
    router.push('/login');
}
</script>

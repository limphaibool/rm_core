<template>
    <Toast />
    <div class="bg-white border-surface-300 border p-6 h-full rounded-xl">
        <div class="text-2xl mb-3">Profile</div>
        <form class="space-y-4" @submit.prevent="updateUser">
            <div class="flex flex-col gap-2">
                <label for="id">User ID</label>
                <InputText id="id" v-model="user.id" placeholder="ID" disabled />
            </div>
            <div class="flex flex-col gap-2">
                <label for="username">Username</label>
                <InputText id="username" v-model="user.username" placeholder="Username" disabled />
            </div>
            <div class="flex flex-col gap-2">
                <label for="nameThai">Thai name</label>
                <InputText id="nameThai" v-model="user.nameThai" placeholder="Thai name" />
                <span v-if="errors.nameThai">{{ errors.nameThai }}</span>
            </div>
            <div class="flex flex-col gap-2">
                <label for="nameEng">English name</label>
                <InputText id="nameEng" v-model="user.nameEng" placeholder="English name" />
                <span v-if="errors.nameEng">{{ errors.nameEng }}</span>
            </div>
            <div class="flex flex-col gap-2">
                <label for="email">Email</label>
                <InputText id="email" v-model="user.email" placeholder="Email" />
                <span v-if="errors.email">{{ errors.email }}</span>
            </div>
            <div class="flex justify-center">
                <Button type="submit" label="Save" />
            </div>
        </form>

    </div>
</template>

<script setup lang="ts">
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import { onMounted } from 'vue';
import useProfile from './useProfile';
import Toast from 'primevue/toast';

onMounted(async () => {
    await getUser();
})

const { user, errors, getUser, updateUser } = useProfile();


</script>

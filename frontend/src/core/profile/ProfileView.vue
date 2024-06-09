<template>
    <Toast />
    <div class="bg-white border-surface-300 border p-6 h-full rounded-xl">
        <div class="text-2xl mb-3">Profile</div>
        <form class="space-y-4" @submit.prevent="updateUser">
            <div class="space-x-2">
                <InputText v-model="user.id" placeholder="ID" disabled />
                <InputText v-model="user.username" placeholder="Username" disabled />
            </div>
            <div class="space-x-2">
                <InputText v-model="user.nameThai" placeholder="ชื่อไทย" />
                <InputText v-model="user.nameEng" placeholder="ชื่ออังกฤษ" />
            </div>
            <div class="space-x-2">
                <InputText v-model="user.email" placeholder="Email" />
            </div>
            <Button label="Save" @click="handleUserLogin" />

        </form>

    </div>
</template>

<script setup lang="ts">
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import { onMounted } from 'vue';
import useProfile from './useProfile';
import { ErrorHandler } from '../../shared/helpers/errorHandler';
import { useToast } from 'primevue/usetoast';
import Toast from 'primevue/toast';


const toast = useToast();

onMounted(async () => {
    try {
        user.value = await getUser();
    } catch (e) {
        const error = ErrorHandler.handle(e);
        toast.add({ severity: 'error', summary: 'Error', detail: error.message, life: 3000 });
    }
})

const handleUserLogin = () => {
    console.log("click");

}

const { user, getUser, updateUser } = useProfile();


</script>

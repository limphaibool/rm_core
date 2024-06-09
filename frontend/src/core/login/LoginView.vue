<template>
    <Toast />
    <div class="flex-grow flex h-full justify-center items-center">
        <div class="text-center w-full  max-w-lg px-8 py-14 rounded-md ">
            <h1 class="text-4xl font-bold text-left text-primary-500 mb-5">Log In</h1>
            <div class="flex flex-col space-y-4">
                <InputGroup>
                    <InputGroupAddon>
                        <i class="pi pi-user"></i>
                    </InputGroupAddon>
                    <InputText v-model="form.username" />
                </InputGroup>
                <InputGroup>
                    <InputGroupAddon>
                        <i class="pi pi-key"></i>
                    </InputGroupAddon>
                    <InputText v-model="form.password" />
                </InputGroup>
                <Button class="bg-primary-500" @click="handleLogin">
                    <div class="text-gray-900">
                        Log In
                    </div>
                </Button>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import InputGroup from 'primevue/inputgroup';
import InputGroupAddon from 'primevue/inputgroupaddon';
import useLogin from './useLogin.ts';
import Toast from 'primevue/toast';
import { useToast } from 'primevue/usetoast';
import { ErrorHandler } from '../../shared/helpers/errorHandler.ts';
import { useRouter } from 'vue-router';
const { form, login } = useLogin();
const toast = useToast();
const router = useRouter();

const handleLogin = async () => {
    try {
        await login();
        router.push('/');
    } catch (e) {
        const error = ErrorHandler.handle(e);
        toast.add({ severity: 'error', summary: 'Error', detail: error.message, life: 3000 });
    }

}
</script>
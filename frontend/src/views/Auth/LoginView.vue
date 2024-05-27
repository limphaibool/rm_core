<script setup lang="ts">
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import InputGroup from 'primevue/inputgroup';
import InputGroupAddon from 'primevue/inputgroupaddon';
import { ref } from 'vue';

const value = ref('');
</script>
<template>
    <div class="flex-grow flex h-full justify-center  items-center">
        <div class="text-center w-1/3 px-8 py-16 rounded-md shadow-2xl bg-secondary-700">

            <h1 class="text-2xl font-bold text-center text-primary-100 mb-10">LOGIN</h1>
            <div class="flex flex-col space-y-4">
                <InputGroup>
                    <InputGroupAddon>
                        <i class="pi pi-user"></i>
                    </InputGroupAddon>
                    <InputText v-model="value" />
                </InputGroup>
                <InputGroup>
                    <InputGroupAddon>
                        <i class="pi pi-key"></i>
                    </InputGroupAddon>
                    <InputText />
                </InputGroup>
                <Button class="bg-primary-500 text-black">Log In</Button>
            </div>

        </div>
    </div>

</template>
<script setup lang="ts">
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import InputGroup from 'primevue/inputgroup';
import InputGroupAddon from 'primevue/inputgroupaddon';
import { ref } from 'vue';

const value = ref('');
</script>
<template>
    <div class="flex-grow flex h-full justify-center items-center">
        <div class="text-center w-full  max-w-lg px-8 py-14 rounded-md ">

            <h1 class="text-4xl font-bold text-left text-primary-500 mb-5">Log In</h1>
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
                <Button class="bg-primary-500">
                    <div class="text-gray-900">
                        Log In
                    </div>
                </Button>
            </div>

        </div>
    </div>

</template>
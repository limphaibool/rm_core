<template>
    <Toast />
    <div class="rounded-md bg-white p-7 border-surface-300 border">
        <div class="mb-5 flex justify-between items-center">
            <div class="text-surface-800 text-3xl">
                เพิ่ม role
            </div>
        </div>
        <form class="space-y-4" @submit.prevent="createRole(newRole)">
            <div class="flex flex-col gap-2">
                <label for="name">Role name</label>
                <InputText id="name" v-model="newRole.name" placeholder="Role name" />
                <span v-if="errors.name">{{ errors.name }}</span>
            </div>
            <div class="flex flex-col gap-2">
                <label for="name">Role parent</label>
                <Dropdown v-model="newRole.parentRole" :options="roles" option-label="name" />
            </div>
            <Button type="submit" label="Save" />
        </form>
    </div>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Dropdown from 'primevue/dropdown';
import Toast from 'primevue/toast';
import useRoles from './useRoles';

onMounted(async () => {
    await getRoles();
});

const newRole = ref<RoleRequest>({
    name: null as string | null,
    parentRole: null as Role | null,
});

const { getRoles, createRole, roles, errors } = useRoles();

</script>

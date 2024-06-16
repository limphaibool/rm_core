<template>
    <div class="rounded-md bg-white p-7 border-surface-300 border">
        <div class="mb-5 flex justify-between items-center">
            <div class="text-surface-800 text-3xl">
                Roles
            </div>
            <Button label="เพิ่ม" @click="goRoleCreateView" class="text-surface-800" icon="pi pi-plus" />
        </div>
        <DataTable :value="roles" striped-rows class="my-4">
            <Column field="name" header="Name"></Column>
            <Column field="enabled" header="Enabled"></Column>
        </DataTable>
    </div>
</template>

<script setup lang="ts">
import { onMounted } from 'vue';
import useRoles from './useRoles';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';


const { roles, getRoles, goRoleCreateView } = useRoles();

onMounted(async () => {
    await getRoles();
    console.log(roles.value);
})
</script>
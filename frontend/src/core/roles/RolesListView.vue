<template>
    <div class="rounded-md bg-white p-7 border-surface-300 border-2">
        <div class="my-3 flex justify-between">
            <div class="text-surface-800 text-3xl">
                Roles
            </div>
            <Button label="เพิ่ม" class="text-surface-800" icon="pi pi-plus" />


        </div>
        <DataTable :value="roles" class="py-4">
            <Column field="name" header="Name"></Column>
        </DataTable>
    </div>
</template>

<script setup lang="ts">
import { onMounted } from 'vue';
import useRoles from './useRoles';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';


const { roles, getRoles } = useRoles();

onMounted(async () => {
    await getRoles();
    console.log(roles.value);
})
</script>
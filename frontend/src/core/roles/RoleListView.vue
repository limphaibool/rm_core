<template>
    <MainCard>
        <div class="flex justify-end items-center">
            <Button label="เพิ่ม" @click="toCreateRoleView" class="text-surface-800" icon="pi pi-plus" />
        </div>
        <DataTable :value="roles" paginator :rows="10" :first="first" :total-records="1000" class="my-4"
            selection-mode="single" data-key="id" @row-click="handleRowClick">
            <Column field="name" header="Name"></Column>
            <Column field="enabled" header="Enabled"></Column>
            <Column field="enabled" header="">
            </Column>
        </DataTable>
    </MainCard>
    <Toast />
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue';
import useRole from './useRole';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import Toast from 'primevue/toast';
import { ErrorHandler } from '../../shared/helpers/errorHandler';
import MainCard from '../../shared/components/MainCard.vue';

const { getRoles, toast, router } = useRole();
const roles = ref<Role[]>([]);
const first = ref(0);

onMounted(async () => {
    try {
        roles.value = await getRoles();
    } catch (e) {
        const error = ErrorHandler.handle(e);
        toast.add({
            severity: "error",
            summary: "Error",
            detail: error.message,
            life: 3000,
        });
    }
});

const toCreateRoleView = () => {
    router.push({ name: "role.create" });
};

const toRoleGetView = (id: number) => {
    router.push({ name: "role.get", params: { id: id } });
};

const handleRowClick = (event: any) => {
    const role: Role = event.data;
    toRoleGetView(role.id);
}

</script>
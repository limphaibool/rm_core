<template>
    <MainCard :title="role?.name">
        <div>{{ role?.id }}</div>
        <div>{{ role?.name }}</div>

    </MainCard>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue';
import MainCard from '../../shared/components/MainCard.vue';
import useRole from './useRole';
import { ErrorHandler } from '../../shared/helpers/errorHandler';
const { getRole, toast, route } = useRole();
const role = ref<Role>();

onMounted(async () => {
    try {
        role.value = await getRole(Number(route.params.id));
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


</script>

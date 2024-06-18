<template>
    <Toast />
    <MainCard>
        <form class="space-y-4" @submit.prevent="handleCreateRole(newRole)">
            <div class="flex flex-col gap-2">
                <label for="name">Role name</label>
                <InputText id="name" v-model="newRole.name" placeholder="Role name" />
                <span v-if="errors.name">{{ errors.name }}</span>
            </div>
            <div class="flex flex-col gap-2">
                <label for="name">Role parent</label>
                <Dropdown v-model="newRole.parentRole" :options="roles" option-label="name" />
                <span v-if="errors.parentRole">{{ errors.parentRole }}</span>
            </div>
            <Button type="submit" label="Save" />
        </form>
    </MainCard>
</template>

<script setup lang="ts">
import { computed, onMounted, ref } from 'vue';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Dropdown from 'primevue/dropdown';
import Toast from 'primevue/toast';
import useRoles from './useRole';
import { ErrorHandler } from '../../shared/helpers/errorHandler';
import MainCard from '../../shared/components/MainCard.vue';

const { getRoles, createRole, toast, router } = useRoles();

const roles = ref<Role[]>([]);
const newRole = ref<RoleRequest>({
    name: null as string | null,
    parentRole: null as Role | null,
    enabled: null
});
const errors = ref({
    name: null as string | null,
    parentRole: null as string | null,
});

onMounted(async () => {
    roles.value = await getRoles();
});

const isValidName = (name: string | null): boolean => {
    if (name === null) return false;
    return name.trim().length > 0;
}

const isValidParentRole = (role: Role | null): boolean => {
    return role !== null;
};
const validate = () => {
    errors.value.name = isValidName(newRole.value.name)
        ? null
        : "Invalid name";
    errors.value.parentRole = isValidParentRole(newRole.value.parentRole)
        ? null
        : "Please select parent role";
};

const isValid = computed(() => {
    return errors.value.name === null && errors.value.parentRole === null;
});

const handleCreateRole = async (newRole: RoleRequest) => {
    validate();
    if (!isValid.value) return;
    newRole.name = newRole.name!.trim();
    try {
        const res = await createRole(newRole);
        toast.add({
            severity: "success",
            summary: "Success",
            detail: res.data.message,
            life: 3000,
        });
        router.back();
    } catch (e) {
        const error = ErrorHandler.handle(e);
        toast.add({
            severity: "error",
            summary: "Error",
            detail: error.message,
            life: 3000,
        });
    }
}
</script>

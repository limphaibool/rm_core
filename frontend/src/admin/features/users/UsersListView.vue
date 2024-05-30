<script setup>
import { onMounted } from 'vue';
import useUsers from './useUsers';
const { getUsers, users } = useUsers();

onMounted(() => {
    getUsers()

})
</script>
<template>
    <ul v-for="user in users">
        <li>{{ user.name }} {{ user.username }}</li>
    </ul>
</template>

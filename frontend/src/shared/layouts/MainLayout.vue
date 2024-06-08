<template>
    <div class="flex flex-col min-h-screen bg-gradient-to-br from-primary-200 to-white">
        <TopBar />
        <div class="flex-grow flex ">
            <MenuBar :menus="menuItems" />
            <main class="flex-grow p-6">
                <RouterView />
            </main>
        </div>
    </div>
</template>
<script setup lang="ts">
import { MenuItem } from 'primevue/menuitem';
import TopBar from '../components/TopBar.vue';
import MenuBar from '../components/MenuBar.vue';
import { ref } from 'vue';
const menuItems = ref<MenuItem[]>([
    {
        label: 'จัดการผู้ใช้',
        url: '/admin/users',
    },
    {
        label: 'จัดการตําแหน่ง',
        url: '/admin/roles',
    },

])
const panelMenuItems = ref<MenuItem[]>([
    {
        label: 'จัดการ User',
        items: [
            {
                label: 'จัดการ User',
                url: '/admin/users',

            },
            {
                label: 'Available users',
                url: '/admin/users',
            }
        ]
    },
    {
        label: 'จัดการ Role',
        items: [
            {
                label: 'Roles',
                url: '/admin/users',

            },
        ]
    },
]);
const items = ref([
    {
        label: 'Files',
        icon: 'pi pi-file',
        items: [
            {
                label: 'Documents',
                icon: 'pi pi-file',
                items: [
                    {
                        label: 'Invoices',
                        icon: 'pi pi-file-pdf',
                        items: [
                            {
                                label: 'Pending',
                                icon: 'pi pi-stop'
                            },
                            {
                                label: 'Paid',
                                icon: 'pi pi-check-circle'
                            }
                        ]
                    },
                    {
                        label: 'Clients',
                        icon: 'pi pi-users'
                    }
                ]
            },
            {
                label: 'Images',
                icon: 'pi pi-image',
                items: [
                    {
                        label: 'Logos',
                        icon: 'pi pi-image'
                    }
                ]
            }
        ]
    },
    {
        label: 'Cloud',
        icon: 'pi pi-cloud',
        items: [
            {
                label: 'Upload',
                icon: 'pi pi-cloud-upload'
            },
            {
                label: 'Download',
                icon: 'pi pi-cloud-download'
            },
            {
                label: 'Sync',
                icon: 'pi pi-refresh'
            }
        ]
    },
    {
        label: 'Devices',
        icon: 'pi pi-desktop',
        items: [
            {
                label: 'Phone',
                icon: 'pi pi-mobile'
            },
            {
                label: 'Desktop',
                icon: 'pi pi-desktop'
            },
            {
                label: 'Tablet',
                icon: 'pi pi-tablet'
            }
        ]
    }
]);
</script>
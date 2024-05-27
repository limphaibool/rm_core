<script setup lang="ts">
import { ref } from 'vue';

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
<template>
    <div class="flex flex-col min-h-screen bg-gradient-to-l from-primary-300 to-white  ">
        <header
            class="m-3 rounded-md bg-secondary-900 font-bold align-middle flex space-x-4 items-center p-6 shadow-xl">
            <div class="text-primary-200">
                QUALITY CERAMIC
            </div>
        </header>
        <div class="flex-grow flex ">
            <div class="bg-slate-800 text-white p-4 w-60 mb-3 ml-3 rounded-md shadow-md flex flex-col">
                <RouterLink to="/users" class="p-2 hover:bg-slate-600 rounded">Users</RouterLink>
                <RouterLink to="/roles" class="p-2 hover:bg-slate-600 rounded">Roles</RouterLink>
            </div>
            <main class="flex-grow p-4">
                <RouterView />
            </main>
        </div>
    </div>
</template>
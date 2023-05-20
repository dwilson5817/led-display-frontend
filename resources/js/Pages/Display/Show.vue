<script setup>
import { Head } from '@inertiajs/vue3';
import {Modal} from "flowbite";
import {onMounted} from "vue";
import DeleteDisplayModal from "@/Pages/Display/Partials/DeleteDisplayModal.vue";
import AppLayout from "../../Layouts/AppLayout.vue";

const props = defineProps({
    display: {
        type: Object,
    },
    deleteModal: {
        type: Modal,
    },
});

onMounted(() => {
    // set the element that trigger the tooltip using hover or click
    const $targetEl = document.getElementById('deleteDisplayModal');

    props.deleteModal = new Modal($targetEl);
})

const showDeleteModal = () => {
    props.deleteModal.show();
};

const hideDeleteModal = () => {
    props.deleteModal.hide();
};
</script>

<template>
    <Head :title="display.name" />

    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit {{ display.name }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 mb-4 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">{{ display.name }} display.</div>
                </div>

                <div id="alert-additional-content-2" class="p-4 mb-4 text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                    <div class="flex items-center">
                        <h3 class="text-lg font-medium">Delete display</h3>
                    </div>
                    <div class="mt-2 mb-4">
                        Click below to delete this display.  This action cannot be undone!
                    </div>
                    <div class="flex">
                        <button @click="showDeleteModal" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <DeleteDisplayModal :display="display" @success="hideDeleteModal" @close="hideDeleteModal" />
    </AppLayout>
</template>

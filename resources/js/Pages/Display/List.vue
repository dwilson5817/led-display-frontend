<script setup>
import { Head } from '@inertiajs/vue3';
import CreateDisplayForm from "@/Pages/Display/Partials/CreateDisplayModal.vue";
import { Modal } from "flowbite";
import { onMounted } from "vue";
import AppLayout from "../../Layouts/AppLayout.vue";

const props = defineProps({
    createModal: {
        type: Modal,
    },
    displays: {
        type: Array,
    },
});

onMounted(() => {
    // set the element that trigger the tooltip using hover or click
    const $targetEl = document.getElementById('createDisplayModal');

    props.createModal = new Modal($targetEl);
})

const showCreateModal = () => {
    props.createModal.show();
}

const closeCreateModal = () => {
    props.createModal.hide();
}

const formatDate = (isoString) => {
    const date = Date.parse(isoString);

    return new Intl.DateTimeFormat('en-GB', { dateStyle: 'full', timeStyle: 'short' }).format(date)
}
</script>

<template>
    <Head title="Displays" />

    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Displays</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="displays.length > 0" class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-4">
                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Your Displays</h5>
                        <button @click="showCreateModal" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" type="button">
                            Create
                        </button>
                    </div>
                    <div class="flow-root">
                        <TransitionGroup name="list" tag="ul" role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                            <li v-for="display in displays" :key="display.id" class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            {{ display.name }}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            {{ display.created_at === display.updated_at ? 'Created' : 'Updated' }} on {{ formatDate(display.updated_at) }}
                                        </p>
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        <a :href="route('display.show', display)" role="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</a>
                                    </div>
                                </div>
                            </li>
                        </TransitionGroup>
                    </div>
                </div>

                <div v-else id="alert-additional-content-1" class="p-4 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert">
                    <div class="flex items-center">
                        <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Info</span>
                        <h3 class="text-lg font-medium">No displays created yet</h3>
                    </div>
                    <div class="mt-2 mb-4">
                        A display is an ordered collection of messages to be displayed on the LED matrix.  Click below to create one now.
                    </div>
                    <div class="flex">
                        <button @click="showCreateModal" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" type="button">
                            Create
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main modal -->
        <CreateDisplayForm @close="closeCreateModal" @success="closeCreateModal" />
    </AppLayout>
</template>

<style>
.list-move, /* apply transition to moving elements */
.list-enter-active,
.list-leave-active {
    transition: all 0.5s ease;
}

.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateX(30px);
}

/* ensure leaving items are taken out of layout flow so that moving
   animations can be calculated correctly. */
.list-leave-active {
    position: absolute;
}
</style>

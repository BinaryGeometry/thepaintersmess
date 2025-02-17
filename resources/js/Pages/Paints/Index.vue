<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {Head} from '@inertiajs/vue3';
import PaintEdit from "@/Components/Paints/PaintEdit.vue";
import PaintList from "@/Components/Paints/PaintList.vue";

import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    paints: Object
});
</script>

<template>

    <Head title="Paints"/>

    <AppLayout title="Paints">
        <section class="mt-[65px]">
            <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 flex">

                <div class="max-w-2xl p-4 sm:p-6 lg:p-8 flex-1">
                    <section
                        class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">

                        <PaintEdit :paint="{}" :endpoint="'paints.store'"/>

                    </section>
                </div>
                <div class="max-w-6xl p-4 sm:p-6 lg:p-8 flex-1">
                    <div class=" bg-white shadow-sm rounded-lg divide-y">

                        <div class="relative">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Image
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Company
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Range
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Paint Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Color
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Controls
                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                <PaintList
                                    v-for="paint in paints.data"
                                    :key="paint.id"
                                    :paint="paint"
                                />
                                </tbody>
                            </table>
                            <Pagination :pagination="paints"></Pagination>
                        </div>


                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>


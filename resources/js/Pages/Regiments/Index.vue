<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {Head} from '@inertiajs/vue3';
import Pagination from "@/Components/Regiments/Pagination.vue";
import RegimentList from "@/Components/Regiments/RegimentList.vue";
import {ref} from "vue";

const props = defineProps({
    regiments: Object
});

const listData = ref(props.regiments);

</script>

<template>

    <Head title="Paints"/>

    <AppLayout title="Paints">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 flex">

            <div class="max-w-2xl p-4 sm:p-6 lg:p-8 flex-1">
                <section
                    class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">

                    <!--                    <Edit :paint="{}" :endpoint="'paints.store'"/>-->

                </section>
            </div>
            <div class="max-w-6xl p-4 sm:p-6 lg:p-8 flex-1">
                <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">

                    <div class="relative">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Gamesystem
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Faction
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Detachment
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Image
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Army
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Unit
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Model
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            <RegimentList
                                v-for="paint in listData.data"
                                :key="paint.id"
                                :paint="paint"
                            />
                            </tbody>
                        </table>
                        <Pagination :pagination="listData"></Pagination>
                    </div>


                </div>
            </div>
        </div>
    </AppLayout>
</template>


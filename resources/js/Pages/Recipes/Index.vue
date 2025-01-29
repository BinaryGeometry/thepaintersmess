<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {Head} from '@inertiajs/vue3';
import {ref} from "vue";
import Palette from "@/Components/Recipes/Palette.vue";
//

const props = defineProps({
    instance: Object
});

console.log(props.instance.gamesystems)

const activeFaction = ref(props.instance.gamesystems[1].factions[2])

</script>
<template>

    <Head title="Recipe"/>

    <AppLayout title="Recipe">


        <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar"
                aria-controls="sidebar-multi-level-sidebar" type="button"
                class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" fill-rule="evenodd"
                      d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
        </button>

        <aside id="sidebar-multi-level-sidebar"
               class="fixed top-[65px] left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
               aria-label="Sidebar">
            <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
                <ul class="space-y-2 font-medium">

                    <li v-for="gamesystem in props.instance.gamesystems">
                        <button type="button"
                                class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                                aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">

                            <span
                                class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{
                                    gamesystem.name
                                }}</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 :class="{'hidden':gamesystem.name !== 'Warhammer'}">
                                viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <ul id="dropdown-example" class="py-2 space-y-2"
                            :class="{'hidden':gamesystem.name !== 'Warhammer'}">
                            <li v-for="faction in gamesystem.factions">
                                <button type="button"
                                        class="flex items-center w-full p-2 pl-4 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                                        aria-controls="dropdown-example-inner"
                                        data-collapse-toggle="dropdown-example-inner">

                                    <span
                                        class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">
                                            {{ faction.name }}
                                        </span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                         fill="none"
                                         :class="{'hidden':faction.name !== 'Night Goblins'}"
                                         viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2" d="m1 1 4 4 4-4"/>
                                    </svg>
                                </button>

                                <ul id="dropdown-example-inner" class="hidd en py-2 space-y-2"
                                    :class="{'hidden':faction.name !== 'Night Goblins'}">
                                    <li v-for="unit in faction.units">
                                        <button type="button"
                                                :class="{'bg-gray-700':unit.name === 'Spearmen', 'text-white':unit.name === 'Spearmen'}"
                                                class="flex items-center w-full p-2 pl-6 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                                                aria-controls="dropdown-example-inner"
                                                data-collapse-toggle="dropdown-example-inner">

                                    <span
                                        class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">
                                            {{ unit.name }}
                                        </span>
                                            <span
                                                class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300"
                                                :class="{'hidden':unit.faction_default !== true}">Default</span>


                                        </button>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>


                </ul>
            </div>
        </aside>


        <div class="p-4 sm:ml-64">
            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
                <h2 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                    {{ activeFaction.name }}</h2>
                <!--                <h4 class="mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">-->
                <!--                    activateFaction.alleigeince</h4>-->
                <div>
                    <div v-for="unit in activeFaction.units">
                        <div id="accordion-collapse" data-accordion="collapse">
                            <h2 id="accordion-collapse-heading-1">
                                <button type="button"
                                        class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                                        data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"
                                        aria-controls="accordion-collapse-body-1">
                                    <span>{{ unit.name }} <i>{{ unit.recipe.level }}</i> <Palette
                                        :paints="unit.recipe.steps"></Palette> </span>
                                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0"
                                         aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round"
                                              stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                                    </svg>
                                </button>
                            </h2>
                            <div id="accordion-collapse-body-1" class="hidden"
                                 aria-labelledby="accordion-collapse-heading-1">
                                <div
                                    class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900 bg-[#f2f2f2d6]">

                                    <p class="mb-2 text-gray-500 dark:text-gray-400">{{ unit.recipe.note }}</p>

                                    <section class="grid grid-cols-4 gap-4 mb-4">
                                        <div v-for="(steps, key, index) in unit.recipe.steps"
                                             class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm
                                        dark:bg-gray-800 dark:border-gray-700">
                                            <a href="#">
                                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                                    {{ key }}</h5>
                                            </a>

                                            <ul v-for="step in steps">
                                                <li class="">
                                                    <span class="inline-block uppercase me-3 ">{{
                                                            step.ingredient
                                                        }}</span>
                                                    <span class="inline-block w-3 h-3 me-2 bg-gray-200 rounded-full"
                                                          :style="{'background-color':step.color_hex}"
                                                    ></span>
                                                    <span class="inline-block"> {{ step.paint }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div
                                            class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm
                                        dark:bg-gray-800 dark:border-gray-700">
                                            <a href="#">
                                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                                    +</h5>
                                            </a>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </AppLayout>
</template>


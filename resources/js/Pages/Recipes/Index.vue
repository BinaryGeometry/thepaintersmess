<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {Head} from '@inertiajs/vue3';
import RecipeSidebar from "@/Components/Recipes/RecipeSidebar.vue";
//

const props = defineProps({
    instance: Object,
    games: Array,
    armys: Array,
    // faction:
    state: Object
});

// console.log(props.state)
// const activeFaction = ref(props.games[props.state.gameId].factions[props.state.factionId])

</script>
<template>

    <Head title="Recipe"/>

    <AppLayout title="Recipe">


        <RecipeSidebar :game-data="props.games" :game-state="props.state"/>

        <!--        <div class="p-4 sm:ml-64 mt-[65px]">-->
        <!--            <div tagsf="p-4 border-2 border-gold-200 border- dashed rounded-lg dark:border-gray-700">-->
        <!--                <h2 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">-->
        <!--                    {{ activeFaction.name }}</h2>-->
        <!--                &lt;!&ndash;                <h4 class="mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">&ndash;&gt;-->
        <!--                &lt;!&ndash;                    activateFaction.alleigeince</h4>&ndash;&gt;-->
        <!--                <div>-->
        <!--                    <div v-for="unit in activeFaction.units">-->
        <!--                        <div id="accordion-collapse" data-accordion="collapse">-->
        <!--                            <h2 id="accordion-collapse-heading-1">-->
        <!--                                <a type="button"-->
        <!--                                   :hre-->
        <!--                                   class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"-->
        <!--                                   data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"-->
        <!--                                   aria-controls="accordion-collapse-body-1">-->
        <!--                                    <span>{{ unit.name }} <i>{{ unit.recipe.level }}</i> <Palette-->
        <!--                                        :paints="unit.recipe.steps"></Palette> </span>-->
        <!--                                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0"-->
        <!--                                         aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"-->
        <!--                                         viewBox="0 0 10 6">-->
        <!--                                        <path stroke="currentColor" stroke-linecap="round"-->
        <!--                                              stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>-->
        <!--                                    </svg>-->
        <!--                                </a>-->
        <!--                            </h2>-->
        <!--                            <div id="accordion-collapse-body-1" class="hidden"-->
        <!--                                 aria-labelledby="accordion-collapse-heading-1">-->
        <!--                                <div-->
        <!--                                    class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900 bg-[#f2f2f2d6]">-->

        <!--                                    <p class="mb-2 text-gray-500 dark:text-gray-400">{{ unit.recipe.note }}</p>-->

        <!--                                    <section class="grid grid-cols-4 gap-4 mb-4">-->
        <!--                                        <div v-for="(steps, key, index) in unit.recipe.steps"-->
        <!--                                             class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm-->
        <!--                                        dark:bg-gray-800 dark:border-gray-700">-->
        <!--                                            <a href="#">-->
        <!--                                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">-->
        <!--                                                    {{ key }}</h5>-->
        <!--                                            </a>-->

        <!--                                            <ul v-for="step in steps">-->
        <!--                                                <li class="">-->
        <!--                                                    <span class="inline-block uppercase me-3 ">{{-->
        <!--                                                            step.ingredient-->
        <!--                                                        }}</span>-->
        <!--                                                    <span class="inline-block w-3 h-3 me-2 bg-gray-200 rounded-full"-->
        <!--                                                          :style="{'background-color':step.color_hex}"-->
        <!--                                                    ></span>-->
        <!--                                                    <span class="inline-block"> {{ step.paint }}</span>-->
        <!--                                                </li>-->
        <!--                                            </ul>-->
        <!--                                        </div>-->
        <!--                                        <div-->
        <!--                                            class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm-->
        <!--                                        dark:bg-gray-800 dark:border-gray-700">-->
        <!--                                            <a href="#">-->
        <!--                                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">-->
        <!--                                                    +</h5>-->
        <!--                                            </a>-->
        <!--                                        </div>-->
        <!--                                    </section>-->
        <!--                                </div>-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->


    </AppLayout>
</template>


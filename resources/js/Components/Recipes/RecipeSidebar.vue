<script setup>

import {ref} from "vue";
import AccordianLink from "@/Components/AccordianLink.vue";

const props = defineProps({
    gameData: Array,
    gameState: Object
})

const filterPaints = (paints) => {
    return paints;
}

let paints = [
    {
        "paint": "Chaos Black",
        "color_hex": "#282828"
    },
    {
        "paint": "Goblin Green",
        "color_hex": "#78BE20"
    },
    {
        "paint": "Scab Red",
        "color_hex": "#C9102F"
    },
    {
        "paint": "Bubonic Brown",
        "color_hex": "#A75523",
    },
    {
        "paint": "Sunburst Yellow",
        "color_hex": "#FFC72C"
    },
    {
        "paint": "Chainmail",
        "color_hex": "#033C5A",
    }
]

const colors = ref(paints);


</script>

<template>
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
                <li v-for="game in props.gameData">
                    <AccordianLink :name="game.name"
                                   :href="route('recipes.index', { gameId: game.id, factionId: 0, armyId: 0, unitId: 0})"
                                   :open="(parseInt(props.gameState.gameId) === parseInt(game.id))"/>
                    <ul id="dropdown-example" class="py-2 space-y-2"
                        :class="{'hidden':parseInt(props.gameState.gameId) !== parseInt(game.id)}">
                        <li v-for="faction in game.factions">
                            <AccordianLink :name="faction.name" class="!pl-4"
                                           :href="route('recipes.index', { gameId: game.id, factionId: faction.id, armyId: 0, unitId: 0})"
                                           :open="parseInt(props.gameState.factionId) === parseInt(faction.id)"/>
                            <ul id="dropdown-example-inner" class="hidd en py-2 space-y-2"
                                :class="{'hidden':parseInt(props.gameState.factionId) !== parseInt(faction.id)}">
                                <li v-for="army in faction.armys">
                                    <AccordianLink :name="army.name" class="!pl-6"
                                                   :href="route('recipes.index', { gameId: game.id, factionId: faction.id, armyId: army.id, unitId: 0})"
                                                   :open="parseInt(props.gameState.armyId) === parseInt(army.id)"/>
                                    <!--                                        <span-->
                                    <!--                                            class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300"-->
                                    <!--                                            :class="{'hidden':unit.faction_default !== true}">Default</span>-->
                                    <ul id="dropdown-example" class="py-2 space-y-2"
                                        :class="{'hidden':parseInt(props.gameState.armyId) !== parseInt(army.id)}">
                                        <li v-for="unit in army.units">
                                            <AccordianLink :name="unit.name" class="!pl-8"
                                                           :href="route('recipes.index', { gameId: game.id, factionId: faction.id, armyId: army.id, unitId: unit.id})"
                                                           :active="parseInt(props.gameState.unitId) === parseInt(unit.id)"
                                                           :last="true"
                                                           :open="parseInt(props.gameState.unitId) === parseInt(unit.id)"/>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </aside>
</template>


<script setup xmlns="http://www.w3.org/1999/html">
import AppLayout from '@/Layouts/AppLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import RecipeSidebar from "@/Components/Recipes/RecipeSidebar.vue";
import RecipeBuilder from "@/Components/Recipes/RecipeBuilder.vue";

const props = defineProps({
    state: Object,
    games: Array,
    armys: Array,
    unit_recipes: Array,
    army_recipes: Array
});

console.log(props.unit_recipes)
console.log(props.armys)

</script>
<template>

    <Head title="Recipe"/>

    <AppLayout title="Recipe">


        <RecipeSidebar :game-data="props.games" :game-state="props.state"/>
        <section class="mt-[65px] sm:ml-64">
            <nav class="grid grid-cols-3 gap-1 mb-1" v-if="props.state.armyId == 0" >
                <Link class="m-6 relative bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700"
                v-for="army in props.armys" 
                :href="route('recipes.index', {gameId: army.game_id, factionId: army.faction_id, armyId: army.id, unitId: 0})">
                    <div class="flex" style=" align-items: stretch;">
                        <div class="" style="
                            flex-basis: 40%; 
                            display: flex;
                            background:#085888;
                            border-radius: 7px 0px 0px 7px;
                            align-items: stretch;
                            box-sizing: border-box; 
                            background-size:cover;
                        "
                        :style="{'background-image': 'url(/regiments/'+army.id+'/image/)'}">
                                &nbsp;
                        </div>
                        <div class="pt-6 p-4 pb-6">
                            <h2 class="text-3xl">{{ army.name }}</h2>
                            <h3 class="text-2xl text-gray-500">{{ army.game_name }} {{ army.faction_name }} </h3>
                        </div>
                    </div>
                </Link>
            </nav>
            <!--                <div :class="{'hidtden':parseInt(props.state.gameId) !== parseInt(game.id)}">-->

            <!--                </div>-->
            <!--                    <li v-for="faction in game.factions">-->
            <!--                        <AccordianLink :name="faction.name" class="!pl-4"-->
            <!--                                       :href="route('recipes.index', { gameId: game.id, factionId: faction.id, armyId: 0, unitId: 0})"-->
            <!--                                       :open="parseInt(props.gameState.factionId) === parseInt(faction.id)"/>-->
            <!--                        <ul id="dropdown-example-inner" class="hidd en py-2 space-y-2"-->
            <!--                            :class="{'hidden':parseInt(props.gameState.factionId) !== parseInt(faction.id)}">-->
            <!--                            <li v-for="army in faction.armys">-->
            <!--                                <AccordianLink :name="army.name" class="!pl-6"-->
            <!--                                               :href="route('recipes.index', { gameId: game.id, factionId: faction.id, armyId: army.id, unitId: 0})"-->
            <!--                                               :open="parseInt(props.gameState.armyId) === parseInt(army.id)"?-->
            <div class="grid grid-cols-2 grid-rows-1 gap-4">
                <div class="p-4" v-if="(props.army_recipes.length > 0)">
                    <div class="p-4 border-2 border-gold-200 border- dashed rounded-lg dark:border-gray-700">
                        <h2 class="text-4xl font-extrabold text-white dark:text-white mb-4 ">
                            {{ props.army_recipes[0].regiment_name }}</h2>
                        <RecipeBuilder :recipes="props.army_recipes"/>
                    </div>
                </div>
                <div class="p-4" v-if="(props.unit_recipes.length > 0)">
                    <div class="p-4 border-2 border-gold-200 border- dashed rounded-lg dark:border-gray-700">
                        <h2 class="text-4xl font-extrabold text-white dark:text-white mb-4 ">
                            {{ props.unit_recipes[0].regiment_name }}</h2>
                        <RecipeBuilder :recipes="props.unit_recipes"/>
                    </div>
                </div>
            </div>

        </section>

    </AppLayout>
</template>




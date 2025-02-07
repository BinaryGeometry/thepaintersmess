<script setup xmlns="http://www.w3.org/1999/html">
import AppLayout from '@/Layouts/AppLayout.vue';
import {Head} from '@inertiajs/vue3';
import RecipeSidebar from "@/Components/Recipes/RecipeSidebar.vue";
import RecipeBuilder from "@/Components/Recipes/RecipeBuilder.vue";

const props = defineProps({
    state: Object,
    games: Array,
    unit_recipes: Array,
    army_recipes: Array
});

console.log(props.unit_recipes)
console.log(props.army_recipes)

</script>
<template>

    <Head title="Recipe"/>

    <AppLayout title="Recipe">


        <RecipeSidebar :game-data="props.games" :game-state="props.state"/>
        <section>
            <div class="p-4 sm:ml-64 mt-[65px]" v-if="(props.army_recipes.length > 0)">
                <div class="p-4 border-2 border-gold-200 border- dashed rounded-lg dark:border-gray-700">
                    <h2 class="text-4xl font-extrabold dark:text-white">{{ props.army_recipes[0].regiment_name }}</h2>
                    <RecipeBuilder :recipes="props.army_recipes"/>
                </div>
            </div>
            <div class="p-4 sm:ml-64 mt-[65px]" v-if="(props.unit_recipes.length > 0)">
                <div class="p-4 border-2 border-gold-200 border- dashed rounded-lg dark:border-gray-700">
                    <h2 class="text-4xl font-extrabold dark:text-white">{{ props.unit_recipes[0].regiment_name }}</h2>
                    <RecipeBuilder :recipes="props.unit_recipes"/>
                </div>
            </div>

        </section>

    </AppLayout>
</template>




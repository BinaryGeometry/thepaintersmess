<script setup>

import {ref} from "vue";
import Palette from "@/Components/Recipes/Palette.vue";
import { useForm } from "@inertiajs/vue3";
import PrimaryButton from "../PrimaryButton.vue";

const props = defineProps({
    recipes: Array,
    state: Object
})

// const filterPaints = (paints) => {
//     return paints;
// }

// let paints = [
//     {
//         "paint": "Chaos Black",
//         "color_hex": "#282828"
//     },
//     {
//         "paint": "Goblin Green",
//         "color_hex": "#78BE20"
//     },
//     {
//         "paint": "Scab Red",
//         "color_hex": "#C9102F"
//     },
//     {
//         "paint": "Bubonic Brown",
//         "color_hex": "#A75523",
//     },
//     {
//         "paint": "Sunburst Yellow",
//         "color_hex": "#FFC72C"
//     },
//     {
//         "paint": "Chainmail",
//         "color_hex": "#033C5A",
//     }
// ]

// const colors = ref(paints);

const toggleThing = (index) => {
    if (props.recipes[index].openToggle === true) {
        props.recipes[index].openToggle = false;
    } else {
        props.recipes[index].openToggle = true;
    }
}
const form = useForm({
    name: '',
    gameId: props.state.gameId || '',
    unitId: props.state.unitId || '',
    armyId: props.state.armyId || '',
    factionId: props.state.factionId || '',
});

const submitForm = () => {
    const formData = new FormData();
    formData.append('name', form.name)
    formData.append('game_id', form.gameId)
    formData.append('faction_id', form.factionId)
    formData.append('army_id', form.armyId)
    formData.append('unit_id', form.unitId)
    // if (props.endpoint.includes('store')) {
        form.post(route('recipes.store', {
            body: formData,
        }))
    // } else {
        // form.post(route(props.endpoint, {
            // _method: 'put', // https://inertiajs.com/file-uploads
            // body: formData,
            // regiment: props.regiment.id
        // }))
    // }
};

const labelClass = ["block", "mb-2", "text-sm", "font-medium", "text-gray-900", "dark:text-white"]
const inputClass = ["bg-gray-50", "border border-gray-300", "text-gray-900", "text-sm", "rounded-lg", "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "p-2.5", "dark:bg-gray-700", "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white dark:focus:ring-blue-500", "dark:focus:border-blue-500"]


</script>

<template>

    <div v-for="(recipe, index) in props.recipes">
        <div id="accordion-collapse" data-accord ion="collapse">
            <h2 id="accordion-collapse-heading-1">
                <a type="button"
                   :class="{
                        'rounded-t-xl ' : (index === 0 || props.recipes.length == 1 ),
                        'border-b-0': (props.recipes.length != index+1 && props.recipes.length != 1)
                   }"
                   @click="toggleThing(index)"
                   class="flex items-center justify-between w-full p-5 font-medium rtl:text-right bg-grey bg-gray-100 text-gray-400 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                   aria-controls="accordion-collapse-body-1"
                >
                    <span class=" text-2xl ">{{ recipe.name }}<i>{{ recipe.note }}</i> <Palette
                        :steps="recipe.steps"></Palette>
                    </span>
                    <svg data-accordion-icon class="w-3 h-3  shrink-0"
                         :class="{
                            'rotate-180': !props.recipes[index].openToggle
                         }"
                         aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5 5 1 1 5"/>
                    </svg>
                </a>
            </h2>
            <div id="accordion-collapse-body-1" :class="{
                'hidden': (recipe['openToggle'] !== true)
            }" aria- labelledby="accordion-collapse-heading-1">
                <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900 bg-[#f2f2f2d6]"
                     :class="{
                        'rounded-b-xl ' : (props.recipes.length == 1 ) && props.recipes[index].openToggle
                }">
                    <p class="mb-2 text-gray-500 dark:text-gray-400">{{ recipe.note }}</p>
                    <section class="grid grid-cols-4 gap-4 mb-4">
                        <div v-for="step in recipe.steps"
                             class="max-w-sm p-6 relative bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight absolute text-gray-900 dark:text-white"
                                style="left: 0;
                                  top: 0;
                                  border: 1px solid #95aacc;
                                  padding:2px;
                                  /*width: 30px;*/
                                  /*height: 30px;*/
                                  color:#61728e;
                                  text-align: center;
                                  min-width:37px;
                                  border-radius: 8px;
                                  opacity: .5;
                                }">
                                {{ step.step }}
                            </h5>
                            <div class="flex mb-[10px]">
                                <span class="inline-block w-3 h-3 bg-gray-200 rounded-full"
                                      style="clip-path: polygon(40% 24%, 45% 20%, 46% 4%, 56% 4%, 57% 21%, 64% 27%, 66% 46%, 66% 51%, 65% 100%, 35% 100%, 35% 50%, 35% 45%);height: 60px;width: 60px;"
                                      :style="{'background-color':step.paint_color_hex}"
                                ></span><!-- https://bennettfeely.com/clippy/ -->
                                <span class="inline-block"> {{ step.paint_name }}</span>
                            </div>
                            <span class="inline-block uppercase me-3" style="position: absolute;
                                bottom: 0;
                                width: 100%;
                                background: #95aacc;
                                left: 0;
                                text-align: center;
                                border-radius: 0px 0px 8px 8px;
                            ">{{ step.surface }}</span>
                        </div>

                        <div
                            class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm  dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"> +</h5>
                            </a>
                        </div>
                    </section>
                </div>
            </div>
            <div id="accordion-collapse-heading-1" v-if="props.recipes.length === index+1">
                <form @submit.prevent="submitForm">
                    <div type="button"
                    :class="{
                        'rounded-t-xl ' : (props.recipes.length < 1 ),
                    }"
                    class="rounded-b-xl flex items-center justify-between w-full p-5 font-medium rtl:text-right bg-grey bg-gray-100 text-gray-400 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                    aria-controls="accordion-collapse-body-1"
                    >
                    
                        <span class=" text-2xl ">
                            
                            <div class="flex">
                                <label :class="labelClass">Recipe Name</label>
                                <input placeholder="" name="paint_name" v-model="form.name" :class="inputClass"/>
                            </div>
                        </span>
                        <PrimaryButton
                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                        >
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5v14m8-7h-2m0 0h-2m2 0v2m0-2v-2M3 11h6m-6 4h6m11 4H4c-.55228 0-1-.4477-1-1V6c0-.55228.44772-1 1-1h16c.5523 0 1 .44772 1 1v12c0 .5523-.4477 1-1 1Z"/>
                            </svg>
                        </PrimaryButton>
                    </div>
                </form>
        </div>
        </div>
    </div>

</template>


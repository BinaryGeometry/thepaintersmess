<script setup>

import {ref} from "vue";

defineProps({
    paints: Object
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
    <ul class="inline-flex -space-x-px text-base h-10">
        <template v-for="(paint, index) in paints">
                <span class="inline-block w-3 h-3 me-2 bg-gray-200 rounded-full"
                      :style="{'background-color':paint.color_hex}"
                ></span>
        </template>
    </ul>
</template>


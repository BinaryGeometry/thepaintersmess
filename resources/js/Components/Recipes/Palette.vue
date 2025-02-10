<script setup>

const props = defineProps({
    steps: Array
})

const filterPaints = (paints) => {
    return paints;
}
</script>

<template>
    <ul class="inline-flex -space-x-px text-base h-10">
        <li v-for="step in props.steps">
            <span class="inline-block w-3 h-3 bg-gray-200 rounded-full"
                  style="clip-path: polygon(40% 24%, 45% 20%, 46% 4%, 56% 4%, 57% 21%, 64% 27%, 66% 46%, 66% 51%, 65% 100%, 35% 100%, 35% 50%, 35% 45%);height: 26px;width: 35px;"
                  :style="{'background-color':step.paint_color_hex}"
            ></span><!-- https://bennettfeely.com/clippy/ -->
        </li>
    </ul>
</template>


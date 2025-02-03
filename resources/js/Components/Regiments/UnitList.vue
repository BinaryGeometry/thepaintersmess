<script setup>
import {onMounted, ref} from "vue";
import emitter2 from "@/Plugins/MyMitt";

const props = defineProps({
    regiment: Object,
})

const editing = ref(false);

const listData = ref([]);

emitter2.on('unitAdded', e => {
    if (e.regimentId === props.regiment.id) {
        getList()
    }
})

const getList = () => {
    axios
        .get(route('regiments.units', {regiment: props.regiment.id}))
        .then(response => listData.value = response.data)
}
onMounted(() => {
    getList()
})
</script>
<style>
img:before {
    content: ' ';
    display: block;
    position: absolute;
    height: 36px;
    width: 36px;
    border: 1px solid grey;
}
</style>
<template>
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="unit in listData">

        <td class="px-6 py-4 font-medium italic text-gray-500 whitespace-nowrap dark:text-white h-full">
            {{ regiment.game_name }}
        </td>
        <td class="px-6 py-4 h-full font-medium  group-hover:text-gray-500 italic whitespace-nowrap dark:text-white h-full">
            {{ regiment.faction_name }}
        </td>
        <td class="px-6 py-4 h-full font-medium italic text-gray-500  whitespace-nowrap dark:text-white h-full">
            {{ regiment.detachment_name }}
        </td>
        <td class="px-6 py-4 font-medium italic text-gray-500  whitespace-nowrap dark:text-white h-full">
            <!--            <img class="h-full" style="height:36px;" :src="'/regiments/'+unit.id+'/image/'" alt="No Image"/>-->
        </td>
        <td class="px-6 py-4 h-full font-medium italic text-gray-500  whitespace-nowrap dark:text-white h-full">
            {{ regiment.name }}
        </td>
        <td class="px-6 py-4 h-full font-medium text-gray-900 whitespace-nowrap dark:text-white h-full">
            <div class="flex">
                <div
                    style="width:36px; height:36px;  flex-grow: 0; flex-shrink: 0;margin-right:10px;box-sizing:border-box;">
                    <img class="h-full" style="height:36px;width:36px;"
                         :src="'/regiments/'+unit.id+'/image/'"
                         alt="&nbsp"/>
                </div>
                <span class="inline-block align-middle" style=" align-self: center; "> {{ unit.name }}</span>
            </div>
        </td>

    </tr>
</template>

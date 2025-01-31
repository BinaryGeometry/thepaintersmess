<script setup>
import {ref} from "vue";

const props = defineProps({
    regiment: Object,
})

const editing = ref(false);

const listData = ref([]);

axios
    .get('/regiments/37/units')
    .then(response => {
        console.log('response', response.data)
        listData.value = response.data
    })
// .finally(() => this.loading = false)

</script>

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
            <img class="h-full" style="height:36px;" :src="'/regiments/'+regiment.id+'/image/'" alt="No Image"/>
        </td>
        <td class="px-6 py-4 h-full font-medium italic text-gray-500  whitespace-nowrap dark:text-white h-full">
            {{ regiment.name }}
        </td>
        <td class="px-6 py-4 h-full font-medium text-gray-900 whitespace-nowrap dark:text-white h-full">
            {{ unit.name }}
        </td>

    </tr>
</template>

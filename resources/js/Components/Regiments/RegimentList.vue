<script setup>
import dayjs from 'dayjs';

import relativeTime from 'dayjs/plugin/relativeTime';
import {ref} from "vue";
import RegimentForm from "@/Components/Regiments/RegimentForm.vue";
import {useForm} from "@inertiajs/vue3";
import UnitList from "@/Components/Regiments/UnitList.vue";
import UnitForm from "@/Components/Regiments/UnitForm.vue";

dayjs.extend(relativeTime);

const props = defineProps({
  regiment: Object,
  choices: Object
})
const form = useForm({
  // brand: props.paint.brand,
});

const editing = ref(false);

const addUnit = ref(false)
const listUnits = ref(false)

</script>

<template>
  <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 h-full">
    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white h-full">
      {{ regiment.game_name }}
    </td>
    <td class="px-6 py-4 h-full font-medium  text-gray-900 whitespace-nowrap dark:text-white h-full">
      {{ regiment.faction_name }}
    </td>
    <td class="px-6 py-4 h-full font-medium text-gray-900 whitespace-nowrap dark:text-white h-full">
      {{ regiment.detachment_name }}
    </td>
    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white h-full">
      <img class="h-full" style="height:36px;" :src="'/regiments/'+regiment.id+'/image/'" alt="No Image"/>
    </td>
    <td class="px-6 py-4 h-full font-medium text-gray-900 whitespace-nowrap dark:text-white h-full">

      {{ regiment.name }}


    </td>
    <td class="px-6 py-4 h-full font-medium text-gray-900 whitespace-nowrap dark:text-white h-full">

      <button alt="Edit"
              v-if="!editing"
              class=" text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-1 text-center inline-flex items-center me-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500"
              @click="editing = true">

        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
             width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
          <path fill-rule="evenodd"
                d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z"
                clip-rule="evenodd"/>
          <path fill-rule="evenodd"
                d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z"
                clip-rule="evenodd"/>
        </svg>
      </button>
      <button alt="Close"
              class=" text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-1 text-center inline-flex items-center me-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500"
              @click="editing = false; form.reset(); form.clearErrors()" v-if="editing">
        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
             width="24" height="24" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M7.99994 10 6 11.9999l1.99994 2M11 5v14m-7 0h16c.5523 0 1-.4477 1-1V6c0-.55228-.4477-1-1-1H4c-.55228 0-1 .44772-1 1v12c0 .5523.44772 1 1 1Z"/>
        </svg>
      </button>
      <button alt="Delete"
              class=" text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-1 text-center inline-flex items-center me-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500"
              @click="editing = false; form.reset(); form.clearErrors()" v-if="editing">
        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
             width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
          <path fill-rule="evenodd"
                d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                clip-rule="evenodd"/>
        </svg>

      </button>
      <button alt="Show Units"
              v-if="!editing"
              class=" text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-1 text-center inline-flex items-center me-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500"
              @click="listUnits = !listUnits">

        <svg v-if="listUnits === true" class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
             xmlns="http://www.w3.org/2000/svg"
             width="24" height="24" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m16 14-4-4-4 4"/>
        </svg>
        <svg v-if="listUnits !== true" class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
             xmlns="http://www.w3.org/2000/svg"
             width="24" height="24" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m10 16 4-4-4-4"/>
        </svg>
      </button>
    </td>

    <td class="px-6 py-4 h-full font-medium text-gray-900 whitespace-nowrap dark:text-white h-full">
      <button alt="Add Unit"
              v-if="!editing"
              class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-1 text-center inline-flex items-center me-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500"
              @click="addUnit = !addUnit">
        <svg class="w-6 h-6 border-1 text-gray-800 dark:text-white" aria-hidden="true"
             xmlns="http://www.w3.org/2000/svg"
             width="24" height="24" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 12h14m-7 7V5"/>
        </svg>
      </button>
    </td>
    <td class="px-6 py-4 h-full font-medium text-gray-900 whitespace-nowrap dark:text-white h-full">

    </td>
  </tr>
  <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-if="editing">
    <td colspan="9" class="p-5 bg-[#5983c1] border border-l-0 border-r-0 border-[#203D75]
     border-t-gray-700 dark:bg-gray-800">
      <RegimentForm :regiment="regiment" :choices="props.choices" :endpoint="'regiments.store'"/>
    </td>
  </tr>

  <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-if="addUnit">
    <td colspan="9" class="p-5 bg-[#5983c1] border border-l-0 border-r-0 border-[#203D75]
     border-t-gray-700 dark:bg-gray-800">
      <UnitForm :regiment="regiment" :endpoint="'regiments.store.unit'"/>
    </td>
  </tr>
  <UnitList :regiment="regiment" v-if="listUnits === true"/>

</template>

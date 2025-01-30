<script setup>
import dayjs from 'dayjs';

import relativeTime from 'dayjs/plugin/relativeTime';
import {ref} from "vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import PaintEdit from "@/Components/Paints/PaintEdit.vue";

dayjs.extend(relativeTime);

const props = defineProps({
    paint: Object
});

// const form = useForm({
//
//     brand: props.paint.brand,
//
// });

// console.log('HERE', props.paint);

const editing = ref(false);
</script>

<template>
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 h-full">
        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white h-full">
            <img class="h-full" style="height:21px;" :src="'/paints/'+paint.id+'/image/'" alt="No Image"/>
        </td>
        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white h-full">
            {{ paint.brand }}
        </td>
        <td class="px-6 py-4 h-full font-medium  text-gray-900 whitespace-nowrap dark:text-white h-full">
            {{ paint.range }}
        </td>
        <td class="px-6 py-4 h-full font-medium text-gray-900 whitespace-nowrap dark:text-white h-full">
            {{ paint.paint_name }}
        </td>
        <td class="px-6 py-4 h-full font-medium text-gray-900 whitespace-nowrap dark:text-white h-full">
            <span class="my-5px" :style="{'background-color':paint.color_hex }"
                  style="margin-right:5px;width:35px;height:100%;display:block;float:left;"></span>
        </td>
        <td class="px-6 py-4 h-full font-medium text-gray-900 whitespace-nowrap dark:text-white h-full">
            <button
                v-if="!editing"
                class="block w-full px-4 py-2 text-left text-sm leading-5 bg-white text-white-700 hover:bg-gray-100 focus:bg-gray-100 transition duration-150 ease-in-out"
                @click="editing = true">
                Edit
            </button>

            <button
                class="block w-full px-4 py-2 text-left text-sm leading-5 bg-white text-white-700 hover:bg-gray-100 focus:bg-gray-100 transition duration-150 ease-in-out"
                @click="editing = false; form.reset(); form.clearErrors()" v-if="editing">Close
            </button>
            <Dropdown v-if="paint.user_id === $page.props.auth.user.id && !editing && false">
                <template #trigger>
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20"
                             fill="currentColor">
                            <path
                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"/>
                        </svg>
                    </button>
                </template>
                <template #content class="bg-white">
                    <button
                        class="block w-full px-4 py-2 text-left text-sm leading-5 bg-white text-white-700 hover:bg-gray-100 focus:bg-gray-100 transition duration-150 ease-in-out"
                        @click="editing = true">
                        Edit
                    </button>
                    <!--                    <button :href="route('paints.destroy', paint.id)" method="delete"-->
                    <!--                            class="block w-full px-4 py-2 text-left text-sm leading-5 bg-white text-white-700 hover:bg-gray-100 focus:bg-gray-100 transition duration-150 ease-in-out"-->
                    <!--                    >DElete-->
                    <!--                    </button>-->
                    <DropdownLink as="button" :href="route('paints.destroy', paint.id)" method="delete"
                    >
                        Delete
                    </DropdownLink>
                </template>
            </Dropdown>
        </td>
    </tr>
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-if="editing">

        <td colspan="6" class="p-5 bg-[#5983c1] border border-l-0 border-r-0 border-[#203D75]
     border-t-gray-700 dark:bg-gray-800">
            <PaintEdit :paint="paint" :endpoint="'paints.update'"/>
        </td>
    </tr>
</template>

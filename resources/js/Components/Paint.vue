<script setup>
import dayjs from 'dayjs';

import relativeTime from 'dayjs/plugin/relativeTime';
import {useForm} from "@inertiajs/vue3";
import {ref} from "vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";

dayjs.extend(relativeTime);

const props = defineProps(['paint']);

const form = useForm({

    brand: props.paint.brand,

});

const editing = ref(false);
</script>

<template>
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 h-full">
        <th scope="row"
            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white h-full">
            <img class="h-full" style="height:21px;" :src="'/paints/'+paint.id+'/image/'" alt="paint-image"/>
        </th>
        <th scope="row"
            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white h-full">
            {{ paint.brand }}
        </th>
        <td class="px-6 py-4 h-full">
            {{ paint.range }}
        </td>
        <td class="px-6 py-4 h-full">
            <span class="my-5px" :style="{'background-color':paint.color_hex }"
                  style="margin-right:5px;width:20px;height:100%;display:block;float:left;"></span>
            {{ paint.paint_name }}
        </td>
        <td class="px-6 py-4 h-full">
            <Dropdown v-if="paint.user.id === $page.props.auth.user.id">
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
        <td class="px-6 py-4">

            <form
                @submit.prevent="form.put(route('paints.update', paint.id), { onSuccess: () => editing = false })">
                <textarea v-model="form.brand"
                          class="mt-4 w-full text-gray-900 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                <InputError :message="form.errors.message" class="mt-2"/>
                <div class="space-x-2">
                    <PrimaryButton class="mt-4">Save</PrimaryButton>
                    <button class="mt-4" @click="editing = false; form.reset(); form.clearErrors()">Cancel</button>
                </div>
            </form>

        </td>
    </tr>
</template>

<script setup>

import PrimaryButton from "@/Components/PrimaryButton.vue";
</script>

<template>
    <form @submit.prevent="form.put(route('paints.update', paint.id), { onSuccess: () => editing = false })">
        <table class="w-full">
            <tbody>


            <tr>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white h-full">
                    <img class="h-full" style="height:21px;" :src="'/paints/'+paint.id+'/image/'"
                         alt="No Image"/>
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white h-full">
                    <select placeholder="range" v-model="form.brand" :class="inputClass"
                            @change="selectBrand($event)">
                        <option disabled selected value="">Please select a Brand</option>
                        <option v-for="option in brandOptions" :value="option.value">
                            {{ option.text }}
                        </option>
                    </select>
                </td>
                <td class="px-6 py-4 h-full font-medium  text-gray-900 whitespace-nowrap dark:text-white h-ful">
                    <select placeholder="range" v-model="form.range" :class="inputClass">
                        <option disabled value="">Please select a Range</option>
                        <option v-for="option in populatedRangeOptions" :value="option.value">
                            {{ option.text }}
                        </option>
                    </select>
                </td>
                <td class="px-6 py-4 h-full font-medium text-gray-900 whitespace-nowrap dark:text-white h-ful">
                    <input placeholder="" name="paint_name" v-model="form.paint_name" :class="inputClass"/>
                    <div class="flex">
                                    <span
                                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-e-0 border-gray-300 border-e-0 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">

                                        <input type="color" id="head" name="head" v-model="form.color_hex"
                                               class="flex-none my-2 rounded-full me-1 "
                                               style="width: 24px;height: 24px;"
                                               value="#888888"/>
                                    </span>
                        <input placeholder="color_hex" name="color_hex" v-model="form.color_hex"
                               class="flex-1 rounded-none rounded-e-lg "
                               :class="inputClass"/>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <PrimaryButton class="mt-4">Save</PrimaryButton>
                    <button class="mt-4" @click="editing = false; form.reset(); form.clearErrors()">Cancel
                    </button>

                </td>
            </tr>
            </tbody>
        </table>
    </form>
</template>

<style scoped>

</style>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {Head, useForm} from '@inertiajs/vue3';
import {ref} from "vue";
import InputError from "@/Components/InputError.vue";
import Paint from "@/Components/Paint.vue";

const props = defineProps({
    paints: Object
});

const url = ref('')

const form = useForm({
    brand: props.paints.brand,
    range: props.paints.range,
    paint_name: props.paints.paint_name,
    paint_ref: props.paints.paint_ref,
    color_name: props.paints.color_name,
    color_hex: props.paints.color_hex,
    paint_type: props.paints.paint_type,
    thumbnail: props.paints.thumbnail,
    available: props.paints.available,
});

const submitFormPost = () => {
    const formData = new FormData();
    formData.append('brand', form.brand)
    formData.append('range', form.range)
    formData.append('paint_name', form.paint_name)
    formData.append('paint_ref', form.paint_ref)
    formData.append('color_name', form.color_name)
    formData.append('color_hex', form.color_hex)
    formData.append('paint_type', form.paint_type)
    formData.append('thumbnail', form.thumbnail)
    formData.append('available', form.available)
    form.post(route('paints.store', {
        body: formData
    }))
};

const previewImage = (e) => {
    const file = e.target.files[0];
    url.value = URL.createObjectURL(file);
    form.thumbnail = file;
};


const brandOptions = ref([
    {text: 'Citadel', value: 'Citadel'},
    {text: 'The Army Painter', value: 'The Army Painter'},
    {text: 'Vallejo', value: 'Vallejo'},
    {text: 'CMS', value: 'CMS'},
    {text: 'Two Thin Coats', value: 'Two Thin Coats'},
])

const rangeOptions = ref([
    {text: 'Constrast [Citadel]', value: 'Constrast [Citadel]', brand: 'Citadel'},
    {text: 'Spray [Citadel]', value: 'Spray [Citadel]', brand: 'Citadel'},
    {text: 'Layer [Citadel]', value: 'Layer [Citadel]', brand: 'Citadel'},
    {text: 'Shade [Citadel]', value: 'Shade [Citadel]', brand: 'Citadel'},
    {text: 'Base [Citadel]', value: 'Base [Citadel]', brand: 'Citadel'},
    {text: 'Technical [Citadel]', value: 'Technical [Citadel]', brand: 'Citadel'},
    {text: 'Air [Citadel]', value: 'Air [Citadel]', brand: 'Citadel'},
    {text: 'Dry [Citadel]', value: 'Dry [Citadel]', brand: 'Citadel'},

    {text: 'Wash [Two Thin Coats]', value: 'Wash [Two Thin Coats]', brand: 'Two Thin Coats'},
    {text: 'Glaze [Two Thin Coats]', value: 'Glaze [Two Thin Coats]', brand: 'Two Thin Coats'},
    {text: 'Midtone [Two Thin Coats]', value: 'Midtone [Two Thin Coats]', brand: 'Two Thin Coats'},
    {text: 'Hightlight [Two Thin Coats]', value: 'Highligh [Two Thin Coats]', brand: 'Two Thin Coats'},
    {text: 'Shadow [Two Thin Coats]', value: 'Shadow [Two Thin Coats]', brand: 'Two Thin Coats'},

    {text: 'Speedpaints [The Army Painter]', value: 'Speedpaints [The Army Painter]', brand: 'The Army Painter'},
    {text: 'Warpaints [The Army Painter]', value: 'Warpaints [The Army Painter]', brand: 'The Army Painter'},
    {
        text: 'Warpaints Metallics [The Army Painter]',
        value: 'Warpaints Metallics [The Army Painter]',
        brand: 'The Army Painter'
    },
    {
        text: 'Warpaints Washes [The Army Painter]',
        value: 'Warpaints Washes [The Army Painter]',
        brand: 'The Army Painter'
    },
    {
        text: 'Warpaints Fanatic [The Army Painter]',
        value: 'Warpaints Fanatic [The Army Painter]',
        brand: 'The Army Painter'
    },
    {
        text: 'Warpaints Fanatic Metal [The Army Painter]',
        value: 'Warpaints Fanatic Metal [The Army Painter]',
        brand: 'The Army Painter'
    },
    {
        text: 'Warpaints Fanatic Wash [The Army Painter]',
        value: 'Warpaints Fanatic Wash [The Army Painter]',
        brand: 'The Army Painter'
    },


    {text: 'Xpress [Vallejo]', value: 'Xpress [Vallejo]', brand: 'Vallejo'},
    {text: 'Game Color Wash [Vallejo]', value: 'Game Color Wash [Vallejo]', brand: 'Vallejo'},
    {text: 'Game Color Special FX [Vallejo]', value: 'Game Color Special FX [Vallejo]', brand: 'Vallejo'},
    {text: 'Game Color Ink [Vallejo]', value: 'Game Color Ink [Vallejo]', brand: 'Vallejo'},
    {text: 'Game Color Fluo [Vallejo]', value: 'Game Color Fluo [Vallejo]', brand: 'Vallejo'},
    {text: 'Game Color Metallic [Vallejo]', value: 'Game Color Metallic [Vallejo]', brand: 'Vallejo'},
    {text: 'Model Air [Vallejo]', value: 'Model Air [Vallejo]', brand: 'Vallejo'},
    {text: 'Metal Color [Vallejo]', value: 'Metal Color [Vallejo]', brand: 'Vallejo'},

    {text: 'Premium [CMS]', value: 'Premium [CMS]', brand: 'CMS'},
    {text: 'Infinate Colour [CMS]', value: 'Infinate Colour [CMS]', brand: 'CMS'},
])

const populatedRangeOptions = ref([])

const selectBrand = ($event) => { // https://stackoverflow.com/questions/66528148/unable-to-loop-through-vue-3-reactive-array-prop-proxy
    populatedRangeOptions.value = [];
    rangeOptions.value.forEach((list) => {
        if (form.brand === list.brand) {
            populatedRangeOptions.value.push(list)
        }
    });
}
// const inputClass = ["block", "w-full", "border-gray-300", "focus:border-indigo-300", "focus:ring", "focus:ring-indigo-200", "focus:ring-opacity-50", "rounded-md shadow-sm", "my-1"]
const labelClass = ["block", "mb-2", "text-sm", "font-medium", "text-gray-900", "dark:text-white"]

const inputClass = ["bg-gray-50", "border border-gray-300", "text-gray-900", "text-sm", "rounded-lg", "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "p-2.5", "dark:bg-gray-700", "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white dark:focus:ring-blue-500", "dark:focus:border-blue-500"]
</script>

<template>

    <Head title="Paints"/>
    <!--    https://flowbite.com/docs/getting-started/vue/-->
    <AppLayout title="Paints">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 flex">

            <div class="max-w-2xl p-4 sm:p-6 lg:p-8 flex-1">
                <section
                    class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">

                    <form @submit.prevent="submitFormPost">
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label :class="labelClass">Brand</label>
                                <select placeholder="range" v-model="form.brand" :class="inputClass"
                                        @change="selectBrand($event)">
                                    <option disabled selected value="">Please select a Brand</option>
                                    <option v-for="option in brandOptions" :value="option.value">
                                        {{ option.text }}
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label :class="labelClass">Range</label>
                                <select placeholder="range" v-model="form.range" :class="inputClass">
                                    <option disabled value="">Please select a Range</option>
                                    <option v-for="option in populatedRangeOptions" :value="option.value">
                                        {{ option.text }}
                                    </option>
                                </select>
                            </div>
                        </div>


                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label :class="labelClass">Paint Name</label>
                                <input placeholder="" name="paint_name" v-model="form.paint_name" :class="inputClass"/>
                            </div>
                            <div>
                                <label :class="labelClass">Hex Color</label>


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
                                    <!--   https://javascript.plainenglish.io/create-a-color-picker-with-vue-js-aad1a44c3d2c-->
                                </div>
                            </div>
                        </div>
                        <div class="grid gap-6 mb-6 md:grid-cols-2">

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                       for="file_input">Upload
                                    file</label>
                                <input
                                    type="file"
                                    @change="previewImage"
                                    ref="photo"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                />

                                <div
                                    v-if="form.errors.image"
                                    class="font-bold text-red-600"
                                >
                                    {{ form.errors.image }}
                                </div>
                            </div>
                            <div>
                                <img
                                    v-if="url.length > 0"
                                    :src="url"
                                    class=" mt-4 h-80 max-h-[100px]"
                                />
                            </div>
                        </div>
                        <InputError :message="form.errors.message" class="mt-2"/>
                        <PrimaryButton
                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                        >Add Paint
                        </PrimaryButton>
                    </form>


                </section>
            </div>
            <div class="max-w-6xl p-4 sm:p-6 lg:p-8 flex-1">
                <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">

                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Image
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Company
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Range
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Paint Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Color
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            <Paint
                                v-for="paint in paints"
                                :key="paint.id"
                                :paint="paint"
                            />
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </AppLayout>
</template>


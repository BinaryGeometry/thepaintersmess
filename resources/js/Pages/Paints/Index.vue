<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {Head, useForm} from '@inertiajs/vue3';
import {ref} from "vue";
import Paint from "@/Components/Paint.vue";
import InputError from "@/Components/InputError.vue";

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

const inputClass = ["block", "w-full", "border-gray-300", "focus:border-indigo-300", "focus:ring", "focus:ring-indigo-200", "focus:ring-opacity-50", "rounded-md shadow-sm", "my-1"]
const labelClass = ["text-cyan-50"]

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
</script>

<template>

    <Head title="Paints"/>

    <AppLayout title="Paints">
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="submitFormPost">
                <!--                , { onSuccess: () => form.reset() })">-->


                <label :class="labelClass">Brand</label>
                <select placeholder="range" v-model="form.brand" :class="inputClass" @change="selectBrand($event)">
                    <option disabled selected value="">Please select a Brand</option>
                    <option v-for="option in brandOptions" :value="option.value">
                        {{ option.text }}
                    </option>
                </select>

                <label :class="labelClass">Range</label>
                <select placeholder="range" v-model="form.range" :class="inputClass">
                    <option disabled value="">Please select a Range</option>
                    <option v-for="option in populatedRangeOptions" :value="option.value">
                        {{ option.text }}
                    </option>
                </select>

                <label :class="labelClass">Paint Name</label>
                <input placeholder="" name="paint_name" v-model="form.paint_name" :class="inputClass"/>

                <!--                <input placeholder="paint_ref" name="paint_ref" v-model="form.paint_ref" :class="inputClass"/>-->
                <!--                <input placeholder="color_name" name="color_name" v-model="form.color_name" :class="inputClass"/>-->
                <label :class="labelClass">Hex Color</label>
                <div class="flex">
                    <input type="color" id="head" name="head" v-model="form.color_hex"
                           class="flex-none my-2 rounded-full me-1 "
                           value="#e66465"/>
                    <input placeholder="color_hex" name="color_hex" v-model="form.color_hex" class="flex-1"
                           :class="inputClass"/>

                </div>
                <!--                https://javascript.plainenglish.io/create-a-color-picker-with-vue-js-aad1a44c3d2c-->
                <textarea
                    name="paint_type"
                    v-model="form.paint_type"
                    placeholder="Type of paint"
                    :class="inputClass"
                ></textarea>

                <input
                    type="file"
                    @change="previewImage"
                    ref="photo"
                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 text-cyan-50"
                />
                <img
                    v-if="url.length > 0"
                    :src="url"
                    class="w-full mt-4 h-80"
                />
                <div
                    v-if="form.errors.image"
                    class="font-bold text-red-600"
                >
                    {{ form.errors.image }}
                </div>
                <!--                <input type="file" v-model="form.thumbnail" @input="form.thumbnail = $event.target.files[0]"/>-->
                <!--                <progress v-if="form.progress" :value="form.progress.percentage" max="100">-->
                <!--                    {{ form.progress.percentage }}%-->
                <!--                </progress>-->
                <InputError :message="form.errors.message" class="mt-2"/>
                <PrimaryButton class="mt-4">Add Paint</PrimaryButton>
            </form>

            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">

                <Paint
                    v-for="paint in paints"
                    :key="paint.id"
                    :paint="paint"
                />

            </div>
        </div>
    </AppLayout>
</template>


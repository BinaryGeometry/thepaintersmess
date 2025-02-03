<script setup>

import {useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import {ref} from "vue";
import axios from "axios";
// import mitt from 'mitt';
import emitter2 from "@/Plugins/MyMitt.js";

const props = defineProps({
    regiment: Object,
    // choices: Array,
    endpoint: String,
});

// const emitter = mitt()

const url = ref('')
const form = useForm({
    name: '',
    unit_id: props.regiment.id,
    thumbnail: '',
});
const submitForm = () => {
    const formData = new FormData();
    formData.append('name', form.name)
    formData.append('unit_id', form.game_id)
    formData.append('thumbnail', form.thumbnail)
    if (props.endpoint.includes('store')) {

        axios.post(route(props.endpoint, {
            regiment: props.regiment.id
        }), formData, {
            headers: {'Content-Type': 'multipart/form-data'},
            transformRequest: formData => formData,
        })
            .then(function (response) {
                //, {regimentId: props.regiment.id})
                emitter2.emit('unitAdded', {regimentId: props.regiment.id})
                console.log('emit unitAdded', response);

            })
            .catch(function (error) {
                console.log(error);
            });
    } else {
        //     axios.post(route(props.endpoint, {
        //         _method: 'put', // https://inertiajs.com/file-uploads
        //         body: formData,
        //         regiment: props.regiment.id,
        //         unit: props.unit.id
        //     }))
        //
    }
};


const previewImage = (e) => {
    const file = e.target.files[0];
    url.value = URL.createObjectURL(file);
    form.thumbnail = file;
};

const labelClass = ["block", "mb-2", "text-sm", "font-medium", "text-gray-900", "dark:text-white"]
const inputClass = ["bg-gray-50", "border border-gray-300", "text-gray-900", "text-sm", "rounded-lg", "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "p-2.5", "dark:bg-gray-700", "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white dark:focus:ring-blue-500", "dark:focus:border-blue-500"]

</script>

<template>
    <form @submit.prevent="submitForm">

        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label :class="labelClass">Unit Name</label>
                <input placeholder="" name="paint_name" v-model="form.name" :class="inputClass"/>
            </div>
            <div>
                <label :class="labelClass">Image</label>
                <div class="flex">

                    <input
                        type="file"
                        @change="previewImage"
                        ref="photo"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-l-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    />
                    <span
                        class="inline-flex items-center px-0 text-sm overflow-hidden text-gray-900 bg-gray-200 border rounded-r-lg border-gray-300 border-s-0 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">

                         <img
                             v-if="url.length > 0"
                             :src="url"
                             class=" h-80 max-h-[36px]"
                         />
                    </span>
                </div>
                <div
                    v-if="form.errors.image"
                    class="font-bold text-red-600"
                >
                    {{ form.errors.image }}
                </div>
            </div>
        </div>
        <InputError :message="form.errors.message" class="mt-2"/>
        <PrimaryButton
            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
        >Add Unit
        </PrimaryButton>
    </form>
</template>

<style scoped>

</style>

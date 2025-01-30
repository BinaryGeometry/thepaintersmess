<script setup>

import {useForm} from "@inertiajs/vue3";
import {ref} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    regiment: Object,
    choices: Array,
    endpoint: String,
});

const form = useForm({
    name: props.regiment.name || '',
    game_id: props.regiment.game_id || '',
    faction_id: props.regiment.faction_id || '',
    detachment_id: props.regiment.detachment_id || '',
    thumbnail: props.regiment.thumbnail || '',
});

const submitForm = () => {
    const formData = new FormData();
    formData.append('name', form.name)
    formData.append('game_id', form.game_id)
    formData.append('faction_id', form.faction_id)
    formData.append('detachment_id', form.detachment_id)
    formData.append('thumbnail', form.thumbnail)
    if (props.endpoint.includes('store')) {
        form.post(route(props.endpoint, {
            body: formData,
        }))
    } else {
        form.post(route(props.endpoint, {
            _method: 'put', // https://inertiajs.com/file-uploads
            body: formData,
            regiment: props.regiment.id
        }))
    }
};

const previewImage = (e) => {
    const file = e.target.files[0];
    url.value = URL.createObjectURL(file);
    form.thumbnail = file;
};

const url = ref('')

let gameChoices = props.choices.filter((choice) => choice.slug === 'games')
const gameOptions = ref(gameChoices)
let factionChoices = props.choices.filter((choice) => choice.slug === 'factions')
const factionOptions = ref(factionChoices)
let detachmentChoices = props.choices.filter((choice) => choice.slug === 'detachments')
const detachmentOptions = ref(detachmentChoices)

const populatedRangeOptions = ref([])
const selectGame = ($event, slug) => { // https://stackoverflow.com/questions/66528148/unable-to-loop-through-vue-3-reactive-array-prop-proxy
    // console.log(props.choices)
    // let tempChoices = gameChoices = props.choices.filter((choice) => choice.ancestor_id === form.game_id)

    // populatedRangeOptions.value = [];
    // rangeOptions.value.forEach((list) => {
    //     if (form.brand === list.brand) {
    //         populatedRangeOptions.value.push(list)
    //     }
    // });
}

const labelClass = ["block", "mb-2", "text-sm", "font-medium", "text-gray-900", "dark:text-white"]
const inputClass = ["bg-gray-50", "border border-gray-300", "text-gray-900", "text-sm", "rounded-lg", "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "p-2.5", "dark:bg-gray-700", "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white dark:focus:ring-blue-500", "dark:focus:border-blue-500"]

// if (props.paint.brand) {
//     selectBrand(props.paint.brand)
// }
// if (props.paint.thumbnail) {
//     url.value = '/paints/' + props.paint.id + '/image/';
// }
</script>
<template>
    <form @submit.prevent="submitForm">
        <div class="grid gap-6 mb-6 md:grid-cols-3">
            <div>
                <label :class="labelClass">Game</label>
                <select placeholder="range" v-model="form.game_id" :class="inputClass"
                        @change="selectGame($event, 'games')">
                    <option disabled selected value="">Choose a Game</option>
                    <option v-for="option in gameOptions" :value="option.value">
                        {{ option.text }}
                    </option>
                </select>
            </div>
            <div>
                <label :class="labelClass">Faction</label>
                <select placeholder="range" v-model="form.faction_id" :class="inputClass">
                    <option disabled selected value="">Choose a Faction</option>
                    <option v-for="option in factionOptions" :value="option.value">
                        {{ option.text }}
                    </option>
                </select>
            </div>
            <div>
                <label :class="labelClass">Detachment</label>
                <select placeholder="range" v-model="form.detachment_id" :class="inputClass">
                    <option disabled selected value="">Choose a Detachment</option>
                    <option v-for="option in detachmentOptions" :value="option.value">
                        {{ option.text }}
                    </option>
                </select>
            </div>
        </div>
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label :class="labelClass">Army Name</label>
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
        >New Army
        </PrimaryButton>
    </form>
</template>
<style scoped>
</style>

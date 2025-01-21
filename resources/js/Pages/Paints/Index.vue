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

const form = useForm({
    brand: props.paints.brand,
    thumbnail: props.paints.thumbnail,
});

const submitFormPost = () => {
    const formData = new FormData();
    formData.append('brand', form.brand)
    formData.append('thumbnail', form.thumbnail)

    // form.put(route('paints.store', {id: props.article.id}), {
    form.post(route('paints.store', {
        body: formData
    }))
};

const url = ref('')


const previewImage = (e) => {
    const file = e.target.files[0];
    url.value = URL.createObjectURL(file);
    console.log(file)
    form.thumbnail = file;
};

// const title = defineModel('title')

// console.log(this, this.$refs)

</script>

<template>

    <Head title="Paints"/>

    <AppLayout title="Paints">
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="submitFormPost">
                <!--                , { onSuccess: () => form.reset() })">-->
                <textarea
                    name="brand"
                    v-model="form.brand"
                    placeholder="Brand of paint"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>

                <!--                <label for="File" class="text-cyan-50">File Upload</label>-->
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


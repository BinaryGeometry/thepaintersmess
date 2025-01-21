<script>

// const props = defineProps(['image']);
//
// const form = useForm({
//     image: props.image.image
// });
//
//
// const submit = () => {
//     if (this.$refs.photo) {
//         this.form.image = this.$refs.photo.files[0];
//     }
//     this.form.post(route("image.store"));
// };
// var url = '/dsdf';
//
//
// const previewImage = (e) => {
//     const file = e.target.files[0];
//     this.url = URL.createObjectURL(file);
// };
</script>


<template>

    <head title="Image Create"/>

    <AppLayout title="Dashboard">

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <!--                            <form @submit.prevent="form.post(route('paints.store'), { onSuccess: () => form.reset() }-->
                            <div>
                                <label for="File">File Upload</label>
                                <input
                                    type="file"
                                    @change="previewImage"
                                    ref="photo"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                                />
                                <img
                                    v-if="url"
                                    :src="url"
                                    class="w-full mt-4 h-80"
                                />
                                <div
                                    v-if="form.errors.image"
                                    class="font-bold text-red-600"
                                >
                                    {{ form.errors.image }}
                                </div>
                            </div>

                            <div class="flex items-center mt-4">
                                <button
                                    class="px-6 py-2 text-white bg-gray-900 rounded"
                                >
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

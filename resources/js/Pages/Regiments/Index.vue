<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {Head} from '@inertiajs/vue3';
import Pagination from "@/Components/Pagination.vue";
import RegimentList from "@/Components/Regiments/RegimentList.vue";
import NewRegiment from "@/Components/Regiments/RegimentForm.vue";
import {reactive} from "vue";

const props = defineProps({
  regiments: Object,
  choices: Array
});

const listData = reactive(props.regiments); // https://michaelnthiessen.com/ref-vs-reactive/
// https://stackoverflow.com/questions/63580187/vue-3-0-how-to-assign-a-prop-to-a-ref-without-changing-the-prop

// watch(props.regiment, () => async (newQuestion, oldQuestion) => {
//   // (team) => form.users = team.users
// });

</script>

<template>

  <Head title="Paints"/>

  <AppLayout title="Paints">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 flex">

      <div class="max-w-2xl p-4 sm:p-6 lg:p-8 flex-1">
        <section
            class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">

          <NewRegiment :regiment="{}" :choices="props.choices" :endpoint="'regiments.store'"/>

        </section>
      </div>
      <div class="max-w-6xl p-4 sm:p-6 lg:p-8 flex-1">
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">

          <div class="relative">
            <table class="table-fixed w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
              <thead
                  class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="px-6 py-3  w-[150px]">
                  Gamesystem
                </th>
                <th scope="col" class="px-6 py-3  w-[100px]">
                  Faction
                </th>
                <th scope="col" class="px-6 py-3  w-[100px]">
                  Detachment
                </th>
                <th scope="col" class="px-6 py-3 w-[100px]">
                  Image
                </th>
                <th scope="col" class="px-6 py-3 w-[200px]">
                  Army
                </th>
                <th scope="col" class="px-6 py-3 w-[132px]">
                  &nbsp;
                </th>
                <th scope="col" class="px-6 py-3">
                  Unit
                </th>
                <th scope="col" class="px-6 py-3">
                  Model
                </th>
              </tr>
              </thead>
              <tbody>

              <RegimentList
                  v-for="paint in props.regiments.data"
                  :key="paint.id"
                  :regiment="paint"
                  :choices="props.choices"
              />
              </tbody>
            </table>
            <Pagination :pagination="props.regiments"></Pagination>
          </div>


        </div>
      </div>
    </div>
  </AppLayout>
</template>


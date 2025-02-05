<script setup>
import {Link} from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    name: String,
    open: Boolean,
    last: Boolean
});

// https://stackoverflow.com/questions/62529550/overriding-tailwind-css-classes-in-a-reusable-vuejs-component  ----> https://github.com/mwnciau/tailwindcss-unimportant
// const classes = computed(() => {
//     return props.active
//         ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-indigo-600 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
//         : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out';
// });
console.log('link', props.active)
</script>

<template>

    <Link
        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
        :class="{
            'dark:bg-gray-700':(open && last),
            'bg-gray-100':(open && last)
        }"
        :href="props.href"
        aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">
            {{ props.name }}
        </span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
             :class="{'hidden':!open || last}">
            viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>
    </Link>
</template>

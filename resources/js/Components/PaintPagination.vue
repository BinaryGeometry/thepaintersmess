<script setup>
import {Link} from '@inertiajs/vue3'

defineProps({
    pagination: Object
})
</script>

<template>
    <nav aria-label="Page navigation example" class="p-1">
        <ul class="inline-flex -space-x-px text-base h-10">
            <template v-for="(link, index) in pagination.links" :key="link.label">


                <li>

                    <Link
                        preserve-scroll
                        :href="link.url ?? ''"
                        v-html="link.label"
                        class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-gray-300  hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        :class="{
                            'text-gray-700': link.active,
                            '!bg-gray-300': link.active,
                            '!text-gray-300': !link.url,
                            'border-e-0': (index != pagination.links.length - 1),
                            'rounded-r-lg': (index == pagination.links.length - 1),
                            'border-e-1': (index == pagination.links.length - 1),
                            'rounded-s-lg': (index == 0)
                        }"
                    />
                </li>
            </template>
        </ul>
    </nav>
</template>


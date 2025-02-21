<template>
<div class="text-center mt-4">
    <nav aria-label="Page navigation example">
        <ul class="inline-flex -space-x-px text-sm">
            <Link
                v-if="meta.current_page !== 1"
                :href="meta.links[0].url"
                v-html="meta.links[0].label"
                class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
            ></Link>

            <template v-for="link in meta.links">
                <li>
                    <Link
                        v-if="Number(link.label) && (meta.current_page - link.label < 3 && meta.current_page - link.label > -3) ||
                              Number(link.label) === 1 || Number(link.label) === meta.last_page"
                        :href="link.url"
                        v-html="link.label"
                        :class="[link.active
                                    ? 'flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'
                                    : 'flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white'
                                ]"
                    ></Link>
                    <p  v-if="Number(link.label) && meta.current_page !== 4 && (meta.current_page - link.label === 3) ||
                              Number(link.label) && (meta.current_page !== meta.last_page - 3) && (meta.current_page - link.label === -3)"
                        class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                    >...</p>
                </li>
            </template>

            <Link
                v-if="meta.current_page !== meta.last_page"
                :href="meta.links[meta.links.length - 1].url"
                v-html="meta.links[meta.links.length - 1].label"
                class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
            ></Link>
        </ul>
    </nav>
</div>
</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "Pagination",

    components: {
        Link
    },

    props: [
        'meta'
    ],
}
</script>

<style scoped>

</style>

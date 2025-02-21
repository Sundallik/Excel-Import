<template>
    <div v-if="tasks" class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">ID</th>
                <th scope="col" class="px-6 py-3">Author</th>
                <th scope="col" class="px-6 py-3">File</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Created</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="task in tasks.data" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ task.id }}
                </th>
                <td class="px-6 py-4">
                    {{ task.user.name }}
                </td>
                <td class="px-6 py-4">
                    {{ task.file.name }}
                </td>
                <td class="px-6 py-4">
                    <Link v-if="task.status === 'Error'" :href="route('tasks.failedRows', task.id)" class="underline text-white">
                        {{ task.status }}
                    </Link>
                    <p v-if="task.status !== 'Error'">{{ task.status }}</p>
                </td>
                <td class="px-6 py-4">
                    {{ task.created_at }}
                </td>
            </tr>
            </tbody>
        </table>
        <pagination :meta="tasks.meta"></pagination>
    </div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Link} from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";

export default {
    name: "Index",
    layout: MainLayout,

    components: {
        Link,
        Pagination
    },

    props: [
        'tasks'
    ]
}
</script>

<style scoped>

</style>

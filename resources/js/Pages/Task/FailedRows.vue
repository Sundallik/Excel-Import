<template>
    <div v-if="failedRows" class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">ID</th>
                <th scope="col" class="px-6 py-3">Column</th>
                <th scope="col" class="px-6 py-3">Row</th>
                <th scope="col" class="px-6 py-3">Message</th>
                <th scope="col" class="px-6 py-3">Task ID</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="failedRow in failedRows.data" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ failedRow.id }}
                </th>
                <td class="px-6 py-4">
                    {{ failedRow.column_name }}
                </td>
                <td class="px-6 py-4">
                    {{ failedRow.row }}
                </td>
                <td class="px-6 py-4">
                    {{ failedRow.message }}
                </td>
                <td class="px-6 py-4">
                    {{ failedRow.task_id }}
                </td>
            </tr>
            </tbody>
        </table>

        <pagination :meta="failedRows.meta"></pagination>
    </div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import Pagination from "@/Components/Pagination.vue";

export default {
    name: "FailedRows",
    layout: MainLayout,

    components: {
        Pagination
    },

    props: [
        'failedRows'
    ]
}
</script>

<style scoped>

</style>

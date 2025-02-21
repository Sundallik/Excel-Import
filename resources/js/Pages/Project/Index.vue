<template>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">ID</th>
                <th scope="col" class="px-6 py-3">Type</th>
                <th scope="col" class="px-6 py-3">Title</th>
                <th scope="col" class="px-6 py-3">Created</th>
                <th scope="col" class="px-6 py-3">Is chain</th>
                <th scope="col" class="px-6 py-3">Workers count</th>
                <th scope="col" class="px-6 py-3">Has outsource</th>
                <th scope="col" class="px-6 py-3">Has investors</th>
                <th scope="col" class="px-6 py-3">Deadline</th>
                <template v-if="projects.data.length > 0" v-for="payment in projects.data[0].payments">
                    <th scope="col" class="px-6 py-3">{{ payment.name }}</th>
                </template>
            </tr>
            </thead>
            <tbody v-if="projects.data.length > 0">
            <tr v-for="project in projects.data" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ project.id }}
                </th>
                <td class="px-6 py-4">
                    {{ project.type.name }}
                </td>
                <td class="px-6 py-4">
                    {{ project.title }}
                </td>
                <td class="px-6 py-4">
                    {{ project.created_at_time }}
                </td>
                <td class="px-6 py-4">
                    {{ project.is_chain ? 'Yes' : 'No' }}
                </td>
                <td class="px-6 py-4">
                    {{ project.worker_count }}
                </td>
                <td class="px-6 py-4">
                    {{ project.has_outsource ? 'Yes' : 'No' }}
                </td>
                <td class="px-6 py-4">
                    {{ project.has_investors ? 'Yes' : 'No' }}
                </td>
                <td class="px-6 py-4">
                    {{ project.deadline }}
                </td>
                <template v-for="payment in project.payments">
                    <td class="px-6 py-4">
                        {{ payment.value }}
                    </td>
                </template>
            </tr>
            </tbody>
        </table>
    </div>
    <pagination :meta="projects.meta"></pagination>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import Pagination from "@/Components/Pagination.vue";

export default {
    name: "Index",
    layout: MainLayout,

    components: {
        Pagination
    },

    props: [
        'projects'
    ]
}
</script>

<style scoped>

</style>

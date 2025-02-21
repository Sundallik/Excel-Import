<template>
    <div>
        <nav class="bg-white border-gray-200 dark:bg-gray-900">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <div class="hidden w-full md:block md:w-auto mx-auto" id="navbar-default">
                    <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                        <li>
                            <Link :href="route('projects.index')" :class="['block py-2 px-3 rounded-sm md:p-0', $page.component === 'Project/Index' ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700 dark:text-white md:dark:text-blue-500' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent']">
                                Projects
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('projects.import')" :class="['block py-2 px-3 rounded-sm md:p-0', $page.component === 'Project/Import' ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700 dark:text-white md:dark:text-blue-500' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent']">
                                Import
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('tasks.index')" :class="['block py-2 px-3 rounded-sm md:p-0', $page.component === 'Task/Index' ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700 dark:text-white md:dark:text-blue-500' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent']">
                                Tasks
                            </Link>
                        </li>
                    </ul>
                </div>
                <a @click.prevent="logout" href="#" class="font-medium block py-2 px-3 rounded-sm md:p-0 text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-700 dark:text-white md:dark:hover:text-red-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                    Logout
                </a>
            </div>
        </nav>
    </div>
</template>


<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "Navbar" ,
    components: {Link},

    methods: {
        logout() {
            this.$inertia.post(route('logout'));
        }
    }
}
</script>

<style scoped>

</style>

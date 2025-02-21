<template>
    <div class="text-center">
        <input @change="setFile" ref="file" type="file" hidden="hidden">
        <button @click.prevent="selectFile" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Select file</button>
        <button v-if="file" @click.prevent="storeFile" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Import</button>
    </div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: "Import",
    layout: MainLayout,

    data() {
        return {
            file: null
        }
    },

    methods: {
        selectFile() {
            this.$refs.file.click()
        },

        setFile(e) {
            this.file = e.target.files[0]
        },

        storeFile() {
            const formData = new FormData()
            formData.set('file', this.file)

            this.$inertia.post('/projects', formData, {
                onSuccess: () => {
                    this.file = null
                    this.$refs.file.value = null
                }
            })
        }
    }
}
</script>

<style scoped>

</style>

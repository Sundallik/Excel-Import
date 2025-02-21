<template>
    <div>
        <navbar></navbar>

        <div class="w-2/3 mx-auto mt-8">
            <slot/>
        </div>
    </div>
</template>

<script>
import Navbar from "@/Components/Navbar.vue";

export default {
    name: "MainLayout",

    components: {
        Navbar
    }
}
</script>

<style scoped>

</style>

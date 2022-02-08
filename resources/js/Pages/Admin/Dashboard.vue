<template>
    <x-head title="Dashboard"/>
    <div class="border border-dotted border-4 border-mh-500 p-4 text-white">
        Hello!
    </div>
</template>

<script>
import { defineComponent } from "vue";
import AdminLayout from "@/Layouts/AdminLayout";

export default defineComponent({
    name: "Dashboard",

    layout: AdminLayout,
})
</script>

<style scoped>

</style>

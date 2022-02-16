<template>
    <x-head title="Dashboard"/>
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-end inline-flex space-x-3">
            <h1 class="title">{{ __('Dashboard') }}</h1>
            <h2 class="sub-title">{{ __('Manage application and settings') }}</h2>
        </div>
        <div>
            <breadcrumbs :pages="[]" />
        </div>
    </div>

    <div class="border border-dotted border-4 border-mh-500 p-4 text-white">
        Hello!
    </div>
</template>

<script>
import { defineComponent } from "vue";
import AdminLayout from "@/Layouts/AdminLayout";
import Breadcrumbs from "@/Components/Breadcrumbs";

export default defineComponent({
  name: "Dashboard",

  layout: AdminLayout,

  components: {
    Breadcrumbs
  }
})
</script>

<style scoped>
h1 {
    @apply text-4xl font-semibold;
}

h2 {
    @apply text-2xl text-zinc-300 font-semibold;
}
</style>

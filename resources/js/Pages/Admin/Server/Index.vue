<template>
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-end inline-flex space-x-3">
            <h1 class="title">{{ __('Servers') }}</h1>
            <h2 class="sub-title">{{ __('Create and manage Servers') }}</h2>
        </div>
        <div>
            <breadcrumbs :pages="[{name: 'Servers', href: route('admin.servers.index'), current: true}]" />
        </div>
    </div>

    <div class="toolbar">
        <div>
            <normal-button as="a" :href="route('admin.servers.index')">
                <x-icon-plus class="w-4 w-4"/>
                <span>{{ __('Create Server') }}</span>
            </normal-button>
        </div>
    </div>

    <pre>{{ JSON.stringify(servers, null, 2)}}</pre>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import Breadcrumbs from "@/Components/Breadcrumbs";
import NormalButton from "@/Components/NormalButton";
import { PlusIcon } from "@heroicons/vue/solid";

export default {
  name: "Index",

  components: {
    Breadcrumbs,
    NormalButton,
    XIconPlus: PlusIcon,
  },

  props: ['servers'],

  layout: AdminLayout,
}
</script>

<style scoped>
h1 {
    @apply text-4xl font-semibold;
}

h2 {
    @apply text-2xl text-zinc-300 font-semibold;
}

.toolbar {
    @apply mb-4 flex items-center justify-between;
}
</style>

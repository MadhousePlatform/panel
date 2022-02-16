<template>
    <x-head title="Nodes"/>
    <div>
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-end inline-flex space-x-3">
                <h1 class="title">{{ __('Nodes') }}</h1>
                <h2 class="sub-title">{{ __('Create and manage nodes') }}</h2>
            </div>
            <div>
                <breadcrumbs :pages="[{name: 'Nodes', href: route('admin.nodes.index'), current: true}]" />
            </div>
        </div>

        <div class="toolbar">
            <div>
                <normal-button as="a" :href="route('admin.nodes.create')">
                    <x-icon-plus class="w-4 w-4"/>
                    <span>{{ __('Create Node') }}</span>
                </normal-button>
            </div>
        </div>

        <div v-if="Object.keys(nodes).length === 0" class="md:p-4 bg-zinc-900 md:rounded shadow">
            <x-link :href="route('admin.nodes.create')" class="group create-btn">
                <div class="flex flex-col items-center justify-center">
                    <x-icon-server class="create-icon" />
                    <span class="create-text">{{ __('Create a new node') }}</span>
                </div>
            </x-link>
        </div>
    </div>
</template>

<script>
import NormalButton from '@/Components/NormalButton'
import AdminLayout from "@/Layouts/AdminLayout";
import { PlusIcon } from "@heroicons/vue/solid";
import { ServerIcon } from "@heroicons/vue/outline";
import Breadcrumbs from "@/Components/Breadcrumbs";

export default {
  name: "Index",

  layout: AdminLayout,

  components: {
    Breadcrumbs,
    NormalButton,
    XIconPlus: PlusIcon,
    XIconServer: ServerIcon,
  },

  data() {
    return {
      nodes: {},
    }
  },

  created() {
    this.getNodes();
  },

  methods: {
    getNodes() {
      window.axios.get(route('api.admin.nodes.index')).then(res => {
        this.nodes = res.data.nodes;
      }).catch(e => {
        this.$toast.error(e.hasOwnProperty('response') ? e.response.data.message : e);
      })
    }
  }
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

.create-btn {
    @apply relative block w-full border-2 border-zinc-500 border-dashed rounded-lg p-12 text-center;
    @apply hover:border-mh-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-zinc-900;
    @apply focus:ring-mh-500 group-hover:text-mh-500;
    @apply transition duration-150 ease-in;
}

.create-text {
    @apply mt-2 block text-lg font-medium text-zinc-300 group-hover:text-mh-500;
    @apply transition duration-150 ease-in;
}

.create-icon {
    @apply h-12 w-12 text-zinc-400 group-hover:text-mh-500;
    @apply transition duration-150 ease-in;
}
</style>

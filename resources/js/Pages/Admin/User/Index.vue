<template>
    <x-head title="User Management"/>
    <div class="mb-8">
        <div class="flex inline-flex items-end space-x-3 mb-4">
            <h1 class="title">{{ __('Users') }}</h1>
            <h2 class="sub-title">{{ __('Create and manage Users') }}</h2>
        </div>

        <div class="toolbar">
            <div>
                <normal-button as="a" :href="route('admin.users.create')">
                    <x-icon-plus class="w-4 w-4"/>
                    <span>{{ __('Create User') }}</span>
                </normal-button>
            </div>
            <div class="flex items-center space-x-4">
                <normal-button>
                    <x-icon-filter class="w-4 w-4"/>
                    <span class="sr-only">{{ __('Filter') }}</span>
                </normal-button>

                <normal-button as="a" :href="route('admin.users.create')">
                    <x-icon-list class="w-4 w-4"/>
                    <span class="sr-only">{{ __('Per Page') }}</span>
                </normal-button>
            </div>
        </div>

        <table class="min-w-full divide-y divide-zinc-700" :aria-label="__('User table')">
            <thead class="bg-zinc-800">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">
                    {{ __('Name') }}
                </th>
                <th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">
                    {{ __('Email') }}
                </th>
                <th scope="col" class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">
                    {{ __('Role') }}
                </th>
                <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">{{ __('Edit') }}</span>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(user, i) in users.data" :key="user.email" :class="i % 2 === 0 ? 'bg-zinc-900' : 'bg-zinc-800'">
                <td class="px-6 py-4 whitespace-nowrap font-medium">
                    {{ user.name }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ user.email }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ roleify(user.admin?.role ?? 'User') }}
                </td>
                <td class="px-6 py-4 text-right">
                    <mh-button as="a" :href="route('admin.users.edit', { uuid: user.uuid })">
                        <x-icon-pencil class="w-4 h-4"/>
                        <span>
                            {{ __('Edit') }}
                        </span>
                    </mh-button>
                </td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="4">
                    <div class="bg-zinc-800 px-4 py-3 w-full flex items-center justify-between border-t border-zinc-900 sm:px-6">
                        <div class="flex-1 flex justify-between sm:hidden">
                            <x-link :href="users.prev_page_url" class="pagination-btn rounded-md">
                                <x-icon-chevron-left class="w-4 h-4"/>
                                <span>{{ __('Previous') }}</span>
                            </x-link>
                            <x-link :href="users.next_page_url" class="pagination-btn rounded-md">
                                <x-icon-chevron-right class="w-4 h-4"/>
                                <span>{{ __('Next') }}</span>
                            </x-link>
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm">
                                    {{ __('Showing') }}
                                    <span class="font-medium">
                                        {{ users.from }}
                                    </span>
                                    {{ __('to') }}
                                    <span class="font-medium">
                                        {{ users.to }}
                                    </span>
                                    {{ __('of') }}
                                    <span class="font-medium">
                                        {{ users.total }}
                                    </span>
                                    {{ __('results') }}.
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                     aria-label="Pagination">
                                    <x-link :href="users.first_page_url" v-if="users.links[0].url !== null"
                                            class="pagination-btn rounded-l-md">
                                        <x-icon-chevron-left class="h-5 w-5" aria-hidden="true"/>
                                        <span class="sr-only">{{ __('First page') }}</span>
                                    </x-link>
                                    <span v-else class="pagination-btn rounded-l-md disabled">
                                        <x-icon-chevron-left class="h-5 w-5" aria-hidden="true"/>
                                        <span class="sr-only">{{ __('First page') }}</span>
                                    </span>

                                    <span v-for="(link, i) in users.links">
                                        <x-link v-if="link.url !== null"
                                                :href="link.url" aria-current="page"
                                                :key="i"
                                                :class="`pagination-btn ${link.active ? 'active' : ''} ${link.label === '...' ? 'disabled' : ''}`">
                                            <span>{{ __(link.label) }}</span>
                                        </x-link>
                                        <span v-else class="pagination-btn disabled" :key="`${i}:${i}`">
                                            <span>{{ __(link.label) }}</span>
                                        </span>
                                    </span>

                                    <x-link :href="users.last_page_url"
                                            v-if="users.links[users.links.length - 1].url !== null"
                                            class="pagination-btn rounded-r-md">
                                        <span class="sr-only">{{ __('Last page') }}</span>
                                        <x-icon-chevron-right class="h-5 w-5" aria-hidden="true"/>
                                    </x-link>
                                    <span v-else class="pagination-btn rounded-r-md disabled">
                                        <span class="sr-only">{{ __('Last page') }}</span>
                                        <x-icon-chevron-right class="h-5 w-5" aria-hidden="true"/>
                                    </span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import AdminLayout from "@/Layouts/AdminLayout";
import MadhouseButton from "@/Components/MadhouseButton";
import { ChevronLeftIcon, ChevronRightIcon, PencilIcon, PlusIcon, FilterIcon, ViewListIcon } from "@heroicons/vue/solid";
import XButton from "@/Jetstream/Button";
import NormalButton from "@/Components/NormalButton";

export default defineComponent({
  name: "Index",

  props: {
    users: Object
  },

  components: {
    NormalButton,
    XButton,
    XIconFilter: FilterIcon,
    XIconList: ViewListIcon,
    XIconPlus: PlusIcon,
    XIconChevronLeft: ChevronLeftIcon,
    XIconChevronRight: ChevronRightIcon,
    MhButton: MadhouseButton,
    XIconPencil: PencilIcon,
  },

  layout: AdminLayout,

  methods: {
    roleify(role) {
      switch (role) {
        case "1":
          return 'Basic';
        case "2":
          return 'Admin';
        case "20":
          return 'Root Admin';
        case "User":
          return "User";
        default:
          return "N/A";
      }
    }
  },

  data() {
    return {
      per_page: 25,
    }
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

.toolbar {
    @apply mb-4 flex items-center justify-between;
}

.pagination-btn:not(.disabled):not(.active) {
    @apply relative inline-flex items-center px-4 py-2 border border-mh-700 text-sm font-medium;
    @apply bg-zinc-900 hover:bg-zinc-800;
    @apply transition duration-150 ease-in;
}

.pagination-btn.active {
    @apply relative inline-flex items-center px-4 py-2 border border-mh-700 text-sm font-medium;
    @apply bg-zinc-700;
}

.pagination-btn.disabled {
    @apply relative inline-flex items-center px-4 py-2 border border-mh-700 text-sm font-medium;
    @apply bg-zinc-700 bg-opacity-75 cursor-not-allowed;
}
</style>

<template>
    <x-head title="User Management"/>
    <div class="my-0">
        <div class="lg:flex lg:items-center lg:justify-between">
            <div class="lg:flex lg:items-end lg:inline-flex lg:space-x-3 px-4 lg:px-0">
                <h1 class="title">{{ __('Users') }}</h1>
                <h2 class="sub-title">{{ __('Create and manage Users') }}</h2>
            </div>
            <div class="hidden lg:inline-flex">
                <div class="toolbar">
                    <normal-button classes="py-3" as="a" :href="route('admin.users.create')">
                        <x-icon-plus class="w-4 w-4"/>
                        <span>{{ __('Create User') }}</span>
                    </normal-button>

                    <breadcrumbs :pages="[{name: 'Users', href: route('admin.users.index'), current: true}]"/>
                </div>
            </div>
            <div class="lg:hidden">
                <div class="toolbar-mobile">
                    <normal-button classes="py-3" as="a" :href="route('admin.users.create')">
                        <x-icon-plus class="w-4 w-4"/>
                        <span>{{ __('Create User') }}</span>
                    </normal-button>
                </div>

                <breadcrumbs :pages="[{name: 'Users', href: route('admin.users.index'), current: true}]"/>
            </div>
        </div>

        <x-table :headers="headers" :paginator="users">
            <template #content>
                <tr v-for="user in usersArray" :key="user.email">
                    <td>
                        {{ user.name }}
                        <p>{{ user.email }}</p>
                    </td>
                    <td class="hidden lg:table-cell">{{ user.email }}</td>
                    <td class="hidden lg:table-cell">
                        {{ user.role }}
                    </td>
                    <td>
                        <mh-button class="py-4" as="a" :href="route('admin.users.edit', { uuid: user.uuid })">
                            {{ __('Edit') }} <span class="sr-only">, {{ user.name }}</span>
                        </mh-button>
                    </td>
                </tr>
            </template>
        </x-table>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import AdminLayout from "@/Layouts/AdminLayout";
import MadhouseButton from "@/Components/MadhouseButton";
import {
  ChevronLeftIcon,
  ChevronRightIcon,
  PencilIcon,
  PlusIcon,
  FilterIcon,
  ViewListIcon
} from "@heroicons/vue/solid";
import XButton from "@/Jetstream/Button";
import NormalButton from "@/Components/NormalButton";
import Breadcrumbs from "@/Components/Breadcrumbs";
import Table from "@/Components/Table";

export default defineComponent({
  name: "Index",

  props: ['users'],

  components: {
    XTable: Table,
    NormalButton,
    XButton,
    XIconFilter: FilterIcon,
    XIconList: ViewListIcon,
    XIconPlus: PlusIcon,
    XIconChevronLeft: ChevronLeftIcon,
    XIconChevronRight: ChevronRightIcon,
    MhButton: MadhouseButton,
    XIconPencil: PencilIcon,
    Breadcrumbs,
  },

  layout: AdminLayout,

  data() {
    return {
      usersArray: [],

      // Pop a # with a tailwind class to modify raw column
      headers: ['Name', 'Email#hidden lg:table-cell', 'Role', 'Edit#sr-only']

    }
  },

  created() {
      let u = this.users.data;
      u.forEach(user => {
        this.usersArray.push({
          name: user.name,
          email: user.email,
          role: this.roleify(user.admin?.role ?? null),
          uuid: user.uuid
        })
      });
  },

  methods: {
    roleify(role) {
      switch (role) {
        case 1:
          return 'Basic';
        case 2:
          return 'Admin';
        case 20:
          return 'Root Admin';
        case "User":
        case null:
          return "User";
        default:
          return "N/A";
      }
    }
  },
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
    @apply mb-2 px-4 mx-4 mt-2 hidden lg:flex justify-between items-stretch px-0 space-x-4;
}

.toolbar-mobile {
    @apply mb-2 mx-4 mt-2 lg:hidden;
}

td {
    @apply whitespace-nowrap py-4 pl-4 pr-3 text-base flex-row-reverse font-medium text-zinc-200 sm:pl-6;
}

td > p {
    @apply table-cell lg:hidden text-sm text-zinc-400;
}
</style>

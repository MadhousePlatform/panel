<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div class="mt-4 overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:-mx-6 md:mx-0 md:rounded-lg">
        <table class="min-w-full divide-y divide-zinc-600">
            <thead class="bg-zinc-700">
            <tr>
                <th scope="col"
                    class="py-3 pl-4 pr-3 text-left text-xs font-medium uppercase tracking-wide text-zinc-100 sm:pl-6">
                    Name
                </th>
                <th scope="col"
                    class="hidden px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-zinc-100 lg:table-cell">
                    Email
                </th>
                <th scope="col"
                    class="hidden px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-zinc-100 lg:table-cell">
                    Role
                </th>
                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
            </thead>
            <tbody class="divide-y divide-zinc-600 bg-zinc-800">
            <tr v-for="user in users" :key="user.email">
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-base font-medium text-zinc-200 sm:pl-6">
                    {{ user.name }}
                    <p class="table-cell lg:hidden text-sm text-zinc-300">
                        {{ user.email }}
                    </p>
                </td>
                <td class="hidden whitespace-nowrap px-3 py-4 text-base text-zinc-200 lg:table-cell">{{ user.email }}</td>
                <td class="hidden whitespace-nowrap px-3 py-4 text-base text-zinc-200 lg:table-cell">
                    {{ roleify(user.admin?.role ?? null) }}
                </td>
                <td class="whitespace-nowrap py-4 pl-3 pr-4 text-right text-base font-medium sm:pr-6">
                    <madhouse-button as="a" :href="route('admin.users.edit', {uuid:user.uuid})">
                        {{ __('Edit') }} <span class="sr-only">, {{ user.name }}</span>
                    </madhouse-button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import MadhouseButton from "@/Components/MadhouseButton";

export default {
  components: { MadhouseButton },
  props: ['users', 'paginator'],

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
}
</script>

<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div class="mt-4 overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:-mx-6 md:mx-0 md:rounded-lg">
        <table class="min-w-full divide-y divide-zinc-600">
            <thead class="bg-zinc-700">
            <tr>
                <th scope="col" v-for="header in headers">
                    <span v-if="header.indexOf('#') > 0" class="sr-only">{{ __(header.split('#')[0]) }}</span>
                    <span v-else>{{ __(header) }}</span>
                </th>
            </tr>
            </thead>
            <tbody class="divide-y divide-zinc-600 bg-zinc-800">
            <slot name="content"/>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="4">
                    <div class="bg-zinc-800 px-4 py-3 w-full flex items-center justify-between border-t border-zinc-900 sm:px-6">
                        <div class="flex-1 flex justify-between lg:hidden">
                            <x-link :href="paginator.prev_page_url" class="pagination-btn rounded-md">
                                <x-icon-chevron-left class="w-4 h-4"/>
                                <span>{{ __('Previous') }}</span>
                            </x-link>
                            <x-link :href="paginator.next_page_url" class="pagination-btn rounded-md">
                                <x-icon-chevron-right class="w-4 h-4"/>
                                <span>{{ __('Next') }}</span>
                            </x-link>
                        </div>
                        <div class="hidden lg:flex-1 lg:flex lg:items-center lg:justify-between">
                            <div>
                                <p class="text-sm">
                                    {{ __('Showing') }}
                                    <span class="font-medium">
                                        {{ paginator.from }}
                                    </span>
                                    {{ __('to') }}
                                    <span class="font-medium">
                                        {{ paginator.to }}
                                    </span>
                                    {{ __('of') }}
                                    <span class="font-medium">
                                        {{ paginator.total }}
                                    </span>
                                    {{ __('results') }}.
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                     aria-label="Pagination">
                                    <x-link :href="paginator.first_page_url" v-if="paginator.links[0].url !== null"
                                            class="pagination-btn rounded-l-md">
                                        <x-icon-chevron-left class="h-5 w-5" aria-hidden="true"/>
                                        <span class="sr-only">{{ __('First page') }}</span>
                                    </x-link>
                                    <span v-else class="pagination-btn rounded-l-md disabled">
                                        <x-icon-chevron-left class="h-5 w-5" aria-hidden="true"/>
                                        <span class="sr-only">{{ __('First page') }}</span>
                                    </span>

                                    <span v-for="(link, i) in paginator.links">
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

                                    <x-link :href="paginator.last_page_url"
                                            v-if="paginator.links[paginator.links.length - 1].url !== null"
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
import MadhouseButton from "@/Components/MadhouseButton";
import { ChevronLeftIcon, ChevronRightIcon} from "@heroicons/vue/solid";

export default defineComponent({
  name: 'TableComponent',

  props: ['headers', 'paginator'],

  components: {
    MadhouseButton,
    XIconChevronLeft: ChevronLeftIcon,
    XIconChevronRight: ChevronRightIcon,
  }
});
</script>

<style scoped>
th {
    @apply py-3 pl-4 pr-3 text-left text-xs font-medium uppercase tracking-wide text-zinc-100 sm:pl-6;
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

.badge {
    @apply inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium;
}

.badge-neutral {
    @apply text-zinc-100 bg-zinc-500;
}
</style>

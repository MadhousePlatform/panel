<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <nav class="flex" aria-label="Breadcrumb">
        <ol role="list" class="container">
            <li class="flex">
                <div class="flex items-center">
                    <x-link href="#" class="segment">
                        <HomeIcon class="flex-shrink-0 h-5 w-5" aria-hidden="true"/>
                        <span class="sr-only">{{ __('Home') }}</span>
                    </x-link>
                </div>
            </li>
            <li v-for="page in pages" :key="page.name" class="flex">
                <div class="flex items-center">
                    <chevron-right-icon class="flex-shrink-0 w-8 h-full text-stone-400" />
                    <x-link :href="page.href" class="segment" :aria-current="page.current ? 'page' : undefined">
                        {{ page.name }}
                    </x-link>
                </div>
            </li>
        </ol>
    </nav>
</template>

<script>
import { HomeIcon, ChevronRightIcon } from '@heroicons/vue/solid'

export default {
  components: {
    HomeIcon,
    ChevronRightIcon
  },

  props: ['pages']
}
</script>

<style scoped>
.container {
    @apply bg-stone-700 rounded-md shadow px-3 py-2 flex space-x-2;
}

.segment {
    @apply ml-2 text-sm font-medium text-stone-100 hover:text-stone-300;
    @apply transition duration-150 ease-in;
}

.segment:last-of-type {
    @apply mr-2;
}

.active {
    @apply bg-slate-800;
}
</style>

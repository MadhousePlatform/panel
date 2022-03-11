<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <x-head :title="__(title)"/>
    <div>
        <TransitionRoot as="template" :show="sidebarOpen">
            <Dialog as="div" class="fixed inset-0 flex z-40 md:hidden" @close="sidebarOpen = false">
                <TransitionChild as="template" enter="transition-opacity ease-linear duration-300"
                                 enter-from="opacity-0" enter-to="opacity-100"
                                 leave="transition-opacity ease-linear duration-300" leave-from="opacity-100"
                                 leave-to="opacity-0">
                    <DialogOverlay class="fixed inset-0 bg-mh-600 bg-opacity-75"/>
                </TransitionChild>
                <TransitionChild as="template" enter="transition ease-in-out duration-300 transform"
                                 enter-from="-translate-x-full" enter-to="translate-x-0"
                                 leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0"
                                 leave-to="-translate-x-full">
                    <div class="relative flex-1 flex flex-col max-w-xs w-full bg-mh-600">
                        <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0"
                                         enter-to="opacity-100" leave="ease-in-out duration-300"
                                         leave-from="opacity-100" leave-to="opacity-0">
                            <div class="absolute top-0 right-0 -mr-12 pt-2">
                                <button type="button"
                                        class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                        @click="sidebarOpen = false">
                                    <span class="sr-only">{{ __('Close sidebar') }}</span>
                                    <XIcon class="h-6 w-6 text-white" aria-hidden="true"/>
                                </button>
                            </div>
                        </TransitionChild>
                        <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                            <div class="flex-shrink-0 flex items-center px-4">
                                <img class="w-auto"
                                     src="/logo.png"
                                     :alt="__('Madhouse Miners - Unleash your inner madness.')"/>
                            </div>
                            <nav aria-label="Mobile Navigation" class="mt-5 px-2 space-y-1">
                                <x-link key="dash-link" :href="route('admin.index')"
                                        :class="[route().current('admin.index') ? 'active' : 'inactive', 'link']">
                                    <x-icon-chip class="w-4 h-4 mr-1"/>
                                    <span>{{ __('Dashboard') }}</span>
                                </x-link>
                                <x-link key="user-link" :href="route('admin.users.index')"
                                        :class="[route().current('admin.users.index') ? 'active' : 'inactive', 'link']">
                                    <x-icon-users class="w-4 h-4 mr-1"/>
                                    <span>{{ __('Users') }}</span>
                                </x-link>
                                <!--<x-link key="node-link" :href="route('admin.nodes.index')"
                                        :class="[route().current('admin.nodes.index') ? 'active' : 'inactive', 'link']">
                                    <x-icon-map class="w-4 h-4 mr-1"/>
                                    <span>{{ __('Nodes') }}</span>
                                </x-link>-->
                                <x-link key="server-link" :href="route('admin.servers.index')"
                                        :class="[route().current('admin.servers.index') ? 'active' : 'inactive', 'link']">
                                    <x-icon-server class="w-4 h-4 mr-1"/>
                                    <span>{{ __('Servers') }}</span>
                                </x-link>
                                <x-link key="game-link" :href="route('admin.games')"
                                        :class="[route().current('admin.games') ? 'active' : 'inactive', 'link']">
                                    <x-icon-bolt class="w-4 h-4 mr-1"/>
                                    <span>{{ __('Games') }}</span>
                                </x-link>
                            </nav>
                        </div>
                        <div class="flex-shrink-0 flex bg-mh-700 p-4">
                            <a href="#" class="flex-shrink-0 group block">
                                <div class="flex items-center">
                                    <div>
                                        <img class="inline-block h-10 w-10 rounded-full"
                                             :src="$page.props.user.profile_photo_url"
                                             :alt="$page.props.user.name"/>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-base font-medium text-white">{{ $page.props.user.name }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </TransitionChild>
                <div class="flex-shrink-0 w-14">
                    <!-- Force sidebar to shrink to fit close icon -->
                </div>
            </Dialog>
        </TransitionRoot>

        <!-- Static sidebar for desktop -->
        <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="flex-1 flex flex-col min-h-0 bg-mh-600">
                <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                    <div class="flex items-center flex-shrink-0 px-4">
                        <img class="w-auto"
                             src="/logo.png"
                             :alt="__('Madhouse Miners - Unleash your inner madness.')"/>
                    </div>
                    <nav aria-label="Desktop navigation" class="mt-5 flex-1 px-2 space-y-2">
                        <x-link key="dash-link" :href="route('admin.index')"
                                :class="[route().current('admin.index') ? 'active' : 'inactive', 'link']">
                            <x-icon-chip class="w-4 h-4 mr-1"/>
                            <span>{{ __('Dashboard') }}</span>
                        </x-link>
                        <x-link key="user-link" :href="route('admin.users.index')"
                                :class="[route().current('admin.users.index') ? 'active' : 'inactive', 'link']">
                            <x-icon-users class="w-4 h-4 mr-1"/>
                            <span>{{ __('Users') }}</span>
                        </x-link>
                        <!-- <x-link key="node-link" :href="route('admin.nodes.index')"
                                :class="[route().current('admin.nodes.index') ? 'active' : 'inactive', 'link']">
                            <x-icon-map class="w-4 h-4 mr-1"/>
                            <span>{{ __('Nodes') }}</span>
                        </x-link>-->
                        <x-link key="server-link" :href="route('admin.servers.index')"
                                :class="[route().current('admin.servers.index') ? 'active' : 'inactive', 'link']">
                            <x-icon-server class="w-4 h-4 mr-1"/>
                            <span>{{ __('Servers') }}</span>
                        </x-link>
                        <x-link key="game-link" :href="route('admin.games')"
                                :class="[route().current('admin.games') ? 'active' : 'inactive', 'link']">
                            <x-icon-bolt class="w-4 h-4 mr-1"/>
                            <span>{{ __('Games') }}</span>
                        </x-link>
                    </nav>
                </div>
                <div class="flex-shrink-0 flex bg-mh-700 p-4">
                    <a href="#" class="flex-shrink-0 w-full group block">
                        <div class="flex items-center">
                            <div>
                                <img class="inline-block h-9 w-9 rounded-full"
                                     :src="$page.props.user.profile_photo_url"
                                     :alt="$page.props.user.name"/>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-white">
                                    {{ $page.props.user.name }}
                                </p>
                                <p class="text-xs font-medium text-gray-200 group-hover:text-gray-200">
                                    <x-link :href="route('profile.show')" class="hover:underline">
                                        {{ __('View profile') }}
                                    </x-link>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="md:pl-64">
            <div class="sticky top-0 z-10 md:hidden pl-1 pt-1 bg-mh-500">
                <button type="button"
                        class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-white
                            hover:text-white0 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        @click="sidebarOpen = true">
                    <span class="sr-only">{{ __('Open sidebar') }}</span>
                    <MenuIcon class="h-6 w-6" aria-hidden="true"/>
                </button>
            </div>
            <main class="">
                <div class="sm:px-6 md:px-8">
                    <div class="py-4 text-zinc-100">
                        <slot/>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>

<script>
import { ref, defineComponent } from 'vue'
import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { MenuIcon, XIcon } from '@heroicons/vue/outline'
import { ChipIcon, UsersIcon, ServerIcon, LocationMarkerIcon, LightningBoltIcon } from '@heroicons/vue/solid'


export default defineComponent({
  name: "AdminLayout",

  props: {
    title: String,
  },

  components: {
    XIconChip: ChipIcon,
    XIconUsers: UsersIcon,
    XIconServer: ServerIcon,
    XIconMap: LocationMarkerIcon,
    XIconBolt: LightningBoltIcon,
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot,
    MenuIcon,
    XIcon,
  },

  setup() {
    const sidebarOpen = ref(false)

    return {
      sidebarOpen,
    }
  },
})
</script>

<style scoped>
.active {
    @apply bg-mh-900 text-white;
}

.active > span {
    @apply font-bold;
}

.inactive {
    @apply text-black hover:bg-mh-800 hover:text-white;
}

.link {
    @apply flex items-center px-2 py-2 font-medium rounded-md;
    @apply transition duration-150 ease-in;
}
</style>

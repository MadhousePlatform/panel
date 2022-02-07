<template>
    <x-head :title="title"/>
    <div class="min-h-full">
        <div class="bg-mh-500 pb-32">
            <Disclosure as="nav" class="bg-mh-500 border-b border-mh-600 lg:border-none"
                        v-slot="{ open }">
                <div class="max-w-8xl mx-auto">
                    <div
                        class="relative h-28 flex items-center justify-between lg:border-b lg:border-mh-600">
                        <div class="px-2 flex items-center lg:px-0">
                            <div class="flex-shrink-0">
                                <img class="block h-24"
                                     src="/logo.png"
                                     alt="Madhouse Miners - Unleash your inner madness"/>
                            </div>
                            <div class="hidden lg:block lg:ml-10">
                                <div class="flex space-x-4 flex-row">
                                    <top-navigation/>
                                </div>
                            </div>
                        </div>
                        <div class="flex-1 px-2 flex justify-center lg:ml-6 lg:justify-end">
                            <div class="max-w-lg w-full lg:max-w-xs">
                                <search/>
                            </div>
                        </div>
                        <div class="flex lg:hidden">
                            <!-- Mobile menu button -->
                            <DisclosureButton
                                class="bg-mh-700 p-2 rounded-md inline-flex items-center justify-center text-mh-100 hover:text-white hover:bg-mh-800 hover:bg-opacity-75 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-mh-500 focus:ring-white">
                                <span class="sr-only">Open main menu</span>
                                <MenuIcon v-if="!open" class="block h-6 w-6" aria-hidden="true"/>
                                <XIcon v-else class="block h-6 w-6" aria-hidden="true"/>
                            </DisclosureButton>
                        </div>
                        <div class="hidden lg:block lg:ml-4">
                            <div class="flex items-center space-x-4" v-if="$page.props.is_authenticated">
                                <Menu as="div" class="relative flex-shrink-0">
                                    <div>
                                        <MenuButton
                                            class="bg-indigo-600 rounded-full flex text-sm text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-indigo-600 focus:ring-white">
                                            <span class="sr-only">Open user menu</span>
                                            <img class="rounded-full h-8 w-8" :src="$page.props.user.profile_photo_url"
                                                 :alt="$page.props.user.name"/>
                                        </MenuButton>
                                    </div>
                                    <transition enter-active-class="transition ease-out duration-100"
                                                enter-from-class="transform opacity-0 scale-95"
                                                enter-to-class="transform opacity-100 scale-100"
                                                leave-active-class="transition ease-in duration-75"
                                                leave-from-class="transform opacity-100 scale-100"
                                                leave-to-class="transform opacity-0 scale-95">
                                        <MenuItems
                                            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                            <MenuItem v-for="item in userNavigation" :key="item.name"
                                                      v-slot="{ active }">
                                                <a :href="item.href"
                                                   :class="[active ? 'bg-gray-100' : '', 'block py-2 px-4 text-sm text-gray-700']">
                                                    {{ item.name }}
                                                </a>
                                            </MenuItem>
                                        </MenuItems>
                                    </transition>
                                </Menu>
                            </div>
                            <div class="flex items-center space-x-4" v-else>
                                <top-navigation :guest_nav="true" />
                            </div>
                        </div>
                    </div>
                </div>

                <DisclosurePanel class="lg:hidden">
                    <div class="px-2 pt-2 pb-3 space-y-1">
                        <top-navigation/>
                    </div>
                    <div class="pt-4 pb-3 border-t border-b bg-mh-600 border-mh-700">
                        <div class="px-5 flex items-center">
                            <div class="flex-shrink-0">
                                <img class="rounded-full h-10 w-10" :src="$page.props.user.profile_photo_url" alt=""/>
                            </div>
                            <div class="ml-3">
                                <div class="text-base font-medium text-white">{{ $page.props.user.name }}</div>
                                <div class="text-sm font-medium text-mh-900">{{ $page.props.user.email }}</div>
                            </div>
                            <button type="button" class="notification-bell">
                                <span class="sr-only">View notifications</span>
                                <BellIcon class="h-6 w-6" aria-hidden="true"/>
                            </button>
                        </div>
                        <div class="mt-3 px-2 space-y-1">
                            <DisclosureButton v-for="item in userNavigation" :key="item.name" as="a" :href="item.href"
                                              class="block rounded-md py-2 px-3 text-base font-medium text-white hover:bg-mh-700 hover:bg-opacity-75">
                                {{ item.name }}
                            </DisclosureButton>
                        </div>
                    </div>
                </DisclosurePanel>
            </Disclosure>
            <header class="max-w-8xl mx-auto py-10 bg-mh-600 bg-opacity-75">
                <div class="px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold text-white">
                        <portal-target name="page-header"/>
                    </h1>
                </div>
            </header>
        </div>

        <main class="-mt-32">
            <div class="max-w-8xl shadow mx-auto mb-12 bg-zinc-900 text-white lg:rounded-b-lg">
                <div class="px-5 py-6 sm:px-6">
                    <slot/>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { SearchIcon } from '@heroicons/vue/solid'
import { BellIcon, MenuIcon, XIcon } from '@heroicons/vue/outline'
import TopNavigation from "@/Prefabs/TopNavigation";
import Search from "@/Prefabs/Search";

const userNavigation = [
    { name: 'Your Profile', href: '#' },
    { name: 'Settings', href: '#' },
    { name: 'Sign out', href: '#' },
]

export default {
    props: {
        title: {
            type: String
        },
    },

    components: {
        Search,
        TopNavigation,
        Disclosure,
        DisclosureButton,
        DisclosurePanel,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
        BellIcon,
        MenuIcon,
        SearchIcon,
        XIcon,
    },

    setup() {
        return {
            userNavigation,
        }
    },
}
</script>

<style scoped>
.notification-bell {
    @apply ml-auto bg-mh-600 flex-shrink-0 rounded-full p-1 text-mh-200 hover:text-white focus:outline-none;
    @apply focus:ring-2 focus:ring-offset-2 focus:ring-offset-mh-600 focus:ring-white;
}
</style>

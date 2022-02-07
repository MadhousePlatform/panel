<template>
    <x-link :href="route('index')" :class="`${route().current('index') ? 'active': ''} lg`"
            :aria-current="route().current('index')" v-if="!guest_nav">
        Home
    </x-link>
    <x-link :href="route('servers')" :class="`${route().current('servers') ? 'active': ''} lg`"
            :aria-current="route().current('servers')" v-if="!guest_nav">
        Servers
    </x-link>
    <x-link :href="route('discord')" :class="`${route().current('discord') ? 'active': ''} lg`"
            :aria-current="route().current('discord')" v-if="!guest_nav">
        Discord
    </x-link>

    <x-link :href="route('login')" :class="`${route().current('login') ? 'active': ''} lg`"
            :aria-current="route().current('login')" v-if="guest_nav">
        Log In
    </x-link>

    <x-link :href="route('register')" :class="`${route().current('register') ? 'active': ''} lg`"
            :aria-current="route().current('register')" v-if="guest_nav">
        Register
    </x-link>
</template>

<script>
export default {
    name: "TopNavigation",

    props: {
        guest_nav: {
            type: Boolean,
            default: false,
        }
    }
}
</script>

<style scoped>
a {
    @apply rounded-md text-center py-2 lg:py-4 px-4 text-sm font-medium flex items-center;
    @apply transition duration-150 ease-in;
}

a.active {
    @apply bg-mh-800 text-white;
}

a:not(.active) {
    @apply text-black hover:bg-mh-900 hover:text-white;
}
</style>

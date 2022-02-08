<template>
    <x-link :href="href" class="">
        <slot />
    </x-link>
</template>

<script>
export default {
    name: "MadhouseButton",

    props: {
        href: String,
        label: String,
    }
}
</script>

<style scoped>
a {
    @apply bg-gradient-to-b from-mh-500 to-mh-700 text-black uppercase tracking-wide font-medium text-sm px-3 py-1.5;
    @apply hover:from-mh-600 hover:to-mh-700 inline-flex items-center space-x-1;
    @apply transition duration-150 ease-in rounded;
}
</style>

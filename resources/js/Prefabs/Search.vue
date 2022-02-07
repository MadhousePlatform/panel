<template>
    <label for="search" class="sr-only">Search</label>
    <div class="relative text-mh-900">
        <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center">
            <SearchIcon class="h-5 w-5" aria-hidden="true"/>
        </div>
        <input id="search" class="" placeholder="Search" type="search" name="search"/>
    </div>
</template>

<script>
import { SearchIcon } from "@heroicons/vue/outline";

export default {
    name: "Search",

    components: {
        SearchIcon,
    }
}
</script>

<style scoped>
input[type="search"] {
    @apply block w-full bg-mh-400 py-2 pl-10 pr-3 lg:text-lg text-base rounded-md border-0 leading-5 text-mh-900;
    @apply placeholder-mh-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-mh-500;
    @apply focus:ring-mh-800 focus:ring-opacity-75 transition duration-150 ease-in;
}
</style>

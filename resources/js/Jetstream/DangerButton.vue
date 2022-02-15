<template>
    <button :type="type" class="">
        <slot></slot>
    </button>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        props: {
            type: {
                type: String,
                default: 'button',
            },
        }
    })
</script>

<style scoped>
a,button {
    @apply bg-gradient-to-b from-red-500 to-red-700 text-white uppercase tracking-wide font-medium text-sm px-3 py-1.5;
    @apply hover:from-red-600 hover:to-red-700 inline-flex items-center space-x-1;
    @apply focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25;
    @apply transition duration-150 ease-in rounded;
}
</style>

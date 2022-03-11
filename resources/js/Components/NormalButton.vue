<template>
    <x-link :href="href" v-if="as === 'a'" :class="['py-1.5 inline-flex items-center space-x-1 rounded', classes]">
        <slot />
    </x-link>

    <button v-else :type="type">
        <slot />
    </button>
</template>

<script>
export default {
  name: "NormalButton",

  props: {
    'as': String,
    href: {
      type: String,
      default: null,
    },
    type: {
      type: String,
      default: 'button',
    },
    classes: {
      type: String,
      default: ''
    }
  }
}
</script>

<style scoped>
a, button {
    @apply bg-gradient-to-b from-zinc-600 to-zinc-700 uppercase tracking-wide font-medium text-sm px-3;
    @apply hover:from-zinc-700 hover:to-zinc-800 shadow-md text-zinc-50;
    @apply focus:outline-none focus:border-zinc-700 focus:ring focus:ring-zinc-200 active:bg-zinc-600 disabled:opacity-25;
    @apply transition duration-150 ease-in;
}
</style>

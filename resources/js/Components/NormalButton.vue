<template>
    <x-link :href="href" v-if="as === 'a'">
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

  }
}
</script>

<style scoped>
a, button {
    @apply bg-gradient-to-b from-zinc-600 to-zinc-700 uppercase tracking-wide font-medium text-sm px-3 py-1.5;
    @apply hover:from-zinc-700 hover:to-zinc-800 inline-flex items-center space-x-1 rounded;
    @apply transition duration-150 ease-in;
}
</style>

<template>
    <x-link v-if="as === 'a'" :href="href" class="">
        <slot/>
    </x-link>

    <button :type="type" v-else class="">
        <slot/>
    </button>
</template>

<script>
export default {
  name: "MadhouseButton",

  props: {
    'as': String,
    href: String,
    type: {
      default: 'button',
    }
  }
}
</script>

<style scoped>
a,button {
    @apply bg-gradient-to-b from-mh-500 to-mh-700 text-black uppercase tracking-wide font-medium text-sm px-3 py-1.5;
    @apply hover:from-mh-600 hover:to-mh-700 inline-flex items-center space-x-1;
    @apply transition duration-150 ease-in rounded;
}
</style>

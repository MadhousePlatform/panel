<template>
    <div class="form-group">
        <label :for="id" class="block text-xs font-medium text-zinc-300">{{ label }}</label>
        <input class="" :placeholder="placeholder" :value="modelValue" :id="id" :type="type" :autocomplete="autocomplete"
               @input="$emit('update:modelValue', $event.target.value)" ref="input"/>
    </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "Input",

  emits: ['update:modelValue'],

  methods: {
    focus() {
      this.$refs.input.focus()
    }
  },

  props: ['modelValue', 'autocomplete', 'label', 'placeholder', 'id', 'type'],
})
</script>

<style scoped>
.form-group {
    @apply border border-zinc-900 rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-zinc-600;
    @apply focus-within:border-zinc-600 bg-zinc-800;
    @apply transition duration-150 ease-in;
}

input {
    @apply block w-full border-0 p-0 text-zinc-100 placeholder-zinc-400 focus:ring-0 sm:text-sm;
    @apply focus:outline-0 focus:border-0 outline-0 bg-zinc-800;
    @apply transition duration-150 ease-in;
}
</style>

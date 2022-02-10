<template>
<pre>{{ JSON.stringify(user, null, 4)}}</pre>
</template>

<script>
import { defineComponent } from "vue";
import AdminLayout from "@/Layouts/AdminLayout";

export default defineComponent({
  name: "Edit",

  layout: AdminLayout,

  props: {
    uuid: String,
  },

  created() {
    this.getUser();
  },

  data() {
    return {
      user: {},
    }
  },

  methods: {
    getUser() {
      window.axios.get(route('api.user.read', { uuid: this.uuid })).then(res => {
        this.user = res.data.user
      }).catch(e => {
        this.$toast.error(e.hasOwnProperty("response") ? e.response.data.message : e);
      })
    }
  }
});
</script>

<style scoped>

</style>

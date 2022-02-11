<template>
    <x-head :title="`${__('Editing')} ${form.name}`"/>
    <pre>{{ JSON.stringify(user, null, 4) }}</pre>
    <div class="max-w-5xl bg-zinc-700 p-6 rounded flex items-start space-x-4">
        <div class="w-1/3">
            <h2>{{ __('Profile Information') }}</h2>
            <p>
                {{ __('Edit basic user details.') }}
                {{ __('You are unable to manually set a users password.') }}
                {{ __('You must use the dedicated "Reset Password" button.') }}
            </p>
        </div>
        <div class="w-2/3">
            <form @submit.prevent="updateUser">
                <div class="">
                    <div class="col-span-6 sm:col-span-4">
                        <x-input :label="__('Name')" id="name" type="text" autofocus
                                 v-model="form.name" autocomplete="name" placeholder="John Deer"/>
                        <!--                    <x-input-error :message="form.errors.name" class="mt-2" />-->
                    </div>

                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <x-input :label="__('Email Address')" id="email" type="email" class="mt-1 block w-full"
                                 v-model="form.email" autocomplete="email" placeholder="john@example.com"/>
                        <!--                    <x-input-error :message="form.errors.email" class="mt-2" />-->
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import AdminLayout from "@/Layouts/AdminLayout";
import FormSection from "@/Jetstream/FormSection";
import XInput from "@/Components/Form/Input";
//import XInputError from "@/Components/InputError";
import { useForm } from "@inertiajs/inertia-vue3";

export default defineComponent({
  name: "Edit",

  components: {
    XInput,
    FormSection,
    //XInputError
  },

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
      form: useForm({
        name: String,
        email: String,
      })
    }
  },

  methods: {
    getUser() {
      window.axios.get(route('api.user.read', { uuid: this.uuid })).then(res => {
        this.form.name = res.data.user.name;
        this.form.email = res.data.user.email;
        this.user = res.data.user;
      }).catch(e => {
        this.$toast.error(e.hasOwnProperty("response") ? e.response.data.message : e);
      })
    },

    updateUser() {
      Promise.resolve(this.form.submit('put', route('api.user.update', { uuid: this.uuid }))).then(() => {
        this.$toast.success(__('The user has been successfully updated.'))
      });
    }
  }
});
</script>

<style scoped>
h2 {
    @apply text-lg font-medium text-white mb-2;
}

p {
    @apply text-zinc-200;
}
</style>

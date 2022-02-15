<template>
    <x-head :title="`${__('Editing')} ${form.name}`"/>
    <pre>{{ JSON.stringify(user, null, 2) }}</pre>

    <form @submit.prevent="updateUser">
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
                <div class="">
                    <div class="col-span-6 sm:col-span-4">
                        <x-input :label="__('Name')" id="name" type="text" autofocus
                                 :disabled="form.processing"
                                 v-model="form.name" autocomplete="name" placeholder="John Deer"/>
                        <input-error :message="form.errors.name" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <x-input :label="__('Email Address')" id="email" type="email" class="mt-1 block w-full"
                                 :disabled="form.processing"
                                 v-model="form.email" autocomplete="email" placeholder="john@example.com"/>
                        <input-error :message="form.errors.email" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-5xl bg-zinc-700 p-6 rounded flex items-start mt-6 space-x-4">
            <div class="w-1/3">
                <h2>{{ __('Role') }}</h2>
                <p>
                    {{ __('Change the role of this user.') }}
                </p>
            </div>
            <div class="w-2/3">
                <RadioGroup v-model="form.role">
                    <RadioGroupLabel class="sr-only">{{ __('Roles') }}</RadioGroupLabel>
                    <div class="rounded-md -space-y-px">
                        <RadioGroupOption as="template" v-for="(role, i) in roles" :key="role.name" :value="role" v-slot="{ checked, active }">
                            <div :class="[i === 0 ? 'rounded-tl-md rounded-tr-md' : '', i === roles.length - 1 ? 'rounded-b-md rounded-br-md' : '', checked ? 'bg-mh-800 z-10' : '', 'border-mh-500 relative border p-4 flex cursor-pointer focus:outline-none']">
                                <span :class="[checked ? 'bg-mh-600 border-transparent' : 'bg-zinc-700 border-mh-300', active ? 'ring-2 ring-offset-2 ring-offset-zinc-700 ring-mh-500' : '', 'h-4 w-4 mt-0.5 cursor-pointer rounded-full border flex items-center justify-center']"
                                    aria-hidden="true">
                                    <span class="rounded-full bg-zinc-700 w-1.5 h-1.5"/>
                                </span>
                                <div class="ml-3 flex flex-col">
                                    <RadioGroupLabel as="span" :class="[checked ? 'text-mh-100 font-bold' : 'text-zinc-100', 'block text-sm font-medium']">
                                        {{ role.name }}
                                    </RadioGroupLabel>
                                    <RadioGroupDescription as="span" :class="[checked ? 'text-mh-300 font-semibold' : 'text-zinc-300', 'block text-sm']">
                                        {{ role.description }}
                                    </RadioGroupDescription>
                                </div>
                            </div>
                        </RadioGroupOption>
                    </div>
                </RadioGroup>
            </div>
        </div>

        <div class="max-w-5xl flex justify-between items-center mt-6">
            <danger-button type="button" @click="confirmingDeletion = true">
                <x-icon-trash class="w-4 h-4" />
                <span>{{ __('Delete User') }}</span>
            </danger-button>
            <jet-confirmation-modal :show="confirmingDeletion" @close="confirmingDeletion = false">
                <template #title>
                    {{ __('Delete User') }}
                </template>
                <template #content>
                    <p>
                        {{ __('Are you sure you want to delete this user account?') }}
                    </p>
                </template>
                <template #footer>
                    <normal-button @click.native="confirmingDeletion = false">
                        Nevermind
                    </normal-button>

                    <danger-button class="ml-2" @click.native="deleteUser" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        <x-icon-trash class="w-4 h-4" />
                        <span>Delete Account</span>
                    </danger-button>
                </template>
            </jet-confirmation-modal>
            <mh-button type="submit" :disabled="form.processing">
                <x-icon-save class="w-4 h-4" />
                <span>{{ __('Save Changes') }}</span>
            </mh-button>
        </div>
    </form>
</template>

<script>
import { defineComponent, ref } from "vue";
import AdminLayout from "@/Layouts/AdminLayout";
import FormSection from "@/Jetstream/FormSection";
import XInput from "@/Components/Form/Input";
import InputError from "@/Jetstream/InputError";
import { useForm } from "@inertiajs/inertia-vue3";
import MhButton from "@/Components/MadhouseButton";
import { TrashIcon, SaveAsIcon } from '@heroicons/vue/solid';
import { RadioGroup, RadioGroupDescription, RadioGroupLabel, RadioGroupOption } from '@headlessui/vue';
import DangerButton from "@/Jetstream/DangerButton";
import ConfirmationModal from "@/Jetstream/ConfirmationModal";
import NormalButton from "@/Components/NormalButton";

export default defineComponent({
  name: "Edit",

  components: {
    NormalButton,
    DangerButton,
    XInput,
    MhButton,
    RadioGroup,
    InputError,
    FormSection,
    RadioGroupLabel,
    RadioGroupOption,
    RadioGroupDescription,
    XIconSave: SaveAsIcon,
    XIconTrash: TrashIcon,
    JetConfirmationModal: ConfirmationModal,
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
      confirmingDeletion: false,
      user: {},
      roles: [
        { id: 1, name: "Basic", description: "Basic administrative privileges." },
        { id: 10, name: "Admin", description: "Most administrative privileges." },
        { id: 20, name: "Root", description: "Full administrative privileges." },
      ],
      form: useForm({
        name: String,
        email: String,
        role: {},
      })
    }
  },

  methods: {
    getUser() {
      window.axios.get(route('api.user.read', { uuid: this.uuid })).then(res => {
        this.form.id = res.data.user.id;
        this.form.name = res.data.user.name;
        this.form.email = res.data.user.email;
        this.user = res.data.user;
        this.form.role = ref(this.roles[this.user.admin?.role - 1])
      }).catch(e => {
        this.$toast.error(e.hasOwnProperty("response") ? e.response.data.message : e);
      })
    },

    deleteUser() {
      window.axios.delete(route('api.user.delete', { uuid: this.uuid })).then(res => {
        this.$toast.success('User has been deleted.')
        this.$inertia.get(route('admin.users.index'));
      }).catch(e => {
        this.$toast.error(e.hasOwnProperty("response") ? e.response.data.message : e);
      });
    },

    updateUser() {
      window.axios.put(route('api.user.update', { uuid: this.uuid }), this.form).then(res => {
        this.$toast.success(res.data.message)
      }).catch(e => {
          this.$toast.error(e.hasOwnProperty("response") ? e.response.data.message : e);
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

<template>
    <x-head :title="`${__('Editing')} ${form.name}`"/>

    <div class="lg:flex lg:items-center lg:justify-betwee mb-4">
        <div class="lg:flex lg:items-end lg:inline-flex lg:space-x-3 px-4 mb-4">
            <h1 class="title">{{ __('Edit User') }}</h1>
            <h2 class="sub-title">{{ __('Update a users profile.') }}</h2>
        </div>
        <div>
            <breadcrumbs v-if="!loading" :pages="[
              {name: 'Users', href: route('admin.users.index'), current: false},
              {name: form.name, href: route('admin.users.edit', { uuid: uuid }), current: true}
              ]"/>
        </div>
    </div>

    <div v-if="loading">
        <div class="bg-zinc-800 lg:rounded py-20">
            <div class="flex items-center justify-center space-x-4 animate-bounce">
                <x-icon-refresh class="animate-spin h-28 w-28 text-zinc-400"/>
                <span class="text-7xl text-zinc-400 font-display">Loading</span>
            </div>
        </div>
    </div>
    <form v-else @submit.prevent="updateUser">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-6 lg:col-span-4">
                <div class="bg-zinc-700 p-6 lg:rounded lg:flex lg:items-start lg:space-x-4">
                    <div class="block lg:w-1/3">
                        <h2>{{ __('Profile Information') }}</h2>
                        <p class="hidden lg:block">
                            {{ __('Edit basic user details.') }}
                            {{ __('You are unable to manually set a users password.') }}
                            {{ __('You must use the dedicated "Reset Password" button.') }}
                        </p>
                    </div>
                    <div class="block lg:w-2/3">
                        <div class="">
                            <div class="col-span-6 sm:col-span-4">
                                <x-input :label="__('Name')" id="name" type="text" autofocus
                                         :disabled="form.processing"
                                         v-model="form.name" autocomplete="name" placeholder="John Deer"/>
                                <input-error :message="form.errors.name" class="mt-2"/>
                            </div>

                            <div class="col-span-6 sm:col-span-4 mt-4">
                                <x-input :label="__('Email Address')" id="email" type="email" class="mt-1 block w-full"
                                         :disabled="form.processing"
                                         v-model="form.email" autocomplete="email" placeholder="john@example.com"/>
                                <input-error :message="form.errors.email" class="mt-2"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-zinc-700 p-6 lg:rounded lg:flex lg:items-start mt-6 lg:space-x-4">
                    <div class="block lg:w-1/3">
                        <h2>{{ __('Role') }}</h2>
                        <p class="hidden lg:block">
                            {{ __('Change the role of this user.') }}
                        </p>
                    </div>
                    <div class="block lg:w-2/3">
                        <RadioGroup v-model="form.admin">
                            <RadioGroupLabel class="sr-only">{{ __('Roles') }}</RadioGroupLabel>
                            <div class="rounded-md border-mh-500 border -space-y-px">
                                <RadioGroupOption as="template" v-for="(role, i) in roles" :key="role.name"
                                                  :value="role"
                                                  v-slot="{ checked, active }">
                                    <div :class="[i !== '20' ? `border-mh-500 border-b` : '', checked ? 'bg-mh-600 z-10' : '', 'relative p-4 flex cursor-pointer focus:outline-none']">
                                        <span :class="[checked ? 'bg-mh-300 border-transparent' : 'bg-zinc-700 border-mh-300', active ? 'ring-2 ring-offset-2 ring-offset-zinc-700 ring-mh-500' : '', 'h-4 w-4 mt-0.5 cursor-pointer rounded-full border flex items-center justify-center']"
                                              aria-hidden="true">
                                            <span :class="[checked ? 'bg-mh-800' : '', `rounded-full w-1.5 h-1.5`]"/>
                                        </span>
                                        <div class="ml-3 flex flex-col">
                                            <RadioGroupLabel as="span"
                                                             :class="[checked ? 'text-black font-bold' : 'text-zinc-100', 'block text-sm font-medium']">
                                                {{ role.name }}
                                            </RadioGroupLabel>
                                            <RadioGroupDescription as="span"
                                                                   :class="[checked ? 'text-black font-semibold' : 'text-zinc-300', 'block text-sm']">
                                                {{ role.description }}
                                            </RadioGroupDescription>
                                        </div>
                                    </div>
                                </RadioGroupOption>
                            </div>
                        </RadioGroup>

                        <danger-button v-show="user.admin !== null" type="button" class="mt-4"
                                       @click="confirmingRoleDeletion = true">
                            <x-icon-minus class="w-4 h-4"/>
                            <span>Remove Role</span>
                        </danger-button>

                        <jet-confirmation-modal :show="confirmingRoleDeletion" @close="confirmingRoleDeletion = false">
                            <template #title>
                                {{ __('Remove Role') }}
                            </template>
                            <template #content>
                                <p>
                                    {{ __('Are you sure you want to remove this users role?') }}
                                </p>
                            </template>
                            <template #footer>
                                <normal-button @click.native="confirmingDeletion = false">
                                    Nevermind
                                </normal-button>

                                <danger-button class="ml-2" @click.native="removeRole"
                                               :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    <x-icon-minus class="w-4 h-4"/>
                                    <span>Delete Role</span>
                                </danger-button>
                            </template>
                        </jet-confirmation-modal>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-6 mx-4">
                    <danger-button type="button" @click="confirmingDeletion = true">
                        <x-icon-trash class="w-4 h-4"/>
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

                            <danger-button class="ml-2" @click.native="deleteUser"
                                           :class="{ 'opacity-25': form.processing }"
                                           :disabled="form.processing">
                                <x-icon-trash class="w-4 h-4"/>
                                <span>Delete Account</span>
                            </danger-button>
                        </template>
                    </jet-confirmation-modal>
                    <mh-button type="submit" :disabled="form.processing">
                        <x-icon-save class="w-4 h-4"/>
                        <span>{{ __('Save Changes') }}</span>
                    </mh-button>
                </div>
            </div>

            <div class="invisible lg:visible lg:col-span-2">
                <div class="bg-zinc-700 w-full p-4 min-h-full rounded">
                    <pre v-if="$page.props.env === 'local'">{{
                            JSON.stringify({
                                id: form.id,
                                name: form.name,
                                email: form.email,
                                admin: form.admin,
                            }, null, 2)
                        }}
                    </pre>
                </div>
            </div>
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
import { TrashIcon, SaveAsIcon, MinusCircleIcon, RefreshIcon } from '@heroicons/vue/solid';
import { RadioGroup, RadioGroupDescription, RadioGroupLabel, RadioGroupOption } from '@headlessui/vue';
import DangerButton from "@/Jetstream/DangerButton";
import ConfirmationModal from "@/Jetstream/ConfirmationModal";
import NormalButton from "@/Components/NormalButton";
import Breadcrumbs from "@/Components/Breadcrumbs";

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
    XIconMinus: MinusCircleIcon,
    XIconRefresh: RefreshIcon,
    JetConfirmationModal: ConfirmationModal,
    Breadcrumbs,
  },

  layout: AdminLayout,

  props: {
    uuid: String,
  },

  mounted() {
    this.getUser();
  },

  data() {
    return {
      loading: true,
      confirmingRoleDeletion: false,
      confirmingDeletion: false,
      user: {},
      roles: {
        1: { role: 1, name: "Basic", description: "Basic administrative privileges." },
        10: { role: 10, name: "Admin", description: "Most administrative privileges." },
        20: { role: 20, name: "Root", description: "Full administrative privileges." },
      },
      form: useForm({
        id: Number,
        name: String,
        email: String,
        admin: {
          role: 0
        },
      })
    }
  },

  methods: {
    getUser() {
      window.axios.get(route('api.admin.users.read', { uuid: this.uuid })).then(res => {
        this.form.id = res.data.user.id;
        this.form.name = res.data.user.name;
        this.form.email = res.data.user.email;
        this.user = res.data.user;
        this.form.admin = window._.get(this.roles, this.user.admin?.role) ?? { role: 0 };
        this.loading = false;
        this.$forceUpdate();
      }).catch(e => {
        this.$toast.error(e.hasOwnProperty("response") ? e.response.data.message : e);
      })
    },

    deleteUser() {
      window.axios.delete(route('api.admin.users.delete', { uuid: this.uuid })).then(res => {
        this.$toast.success('User has been deleted.')
        this.$inertia.get(route('admin.users.index'));
      }).catch(e => {
        this.$toast.error(e.hasOwnProperty("response") ? e.response.data.message : e);
      });
    },

    updateUser() {
      window.axios.put(route('api.admin.users.update', { uuid: this.uuid }), this.form).then(res => {
        this.$toast.success(res.data.message)
        this.getUser();
      }).catch(e => {
        this.$toast.error(e.hasOwnProperty("response") ? e.response.data.message : e);
      });
    },

    removeRole() {
      window.axios.put(route('api.admin.users.update', { uuid: this.uuid }), {
        user: this.user,
        action: 'removeRole'
      }).then(res => {
        this.getUser();
        this.confirmingRoleDeletion = false;
        this.$toast.success('User has been updated.')
      }).catch(e => {
        this.$toast.error(e.hasOwnProperty("response") ? e.response.data.message : e);
      });
    }
  }
});
</script>

<style scoped>
h2:not(.sub-title) {
    @apply text-lg font-medium text-white mb-2;
}

p {
    @apply text-zinc-200;
}

h1 {
    @apply text-4xl font-semibold;
}

h2.sub-title {
    @apply text-2xl text-zinc-300 font-semibold;
}
</style>

<template>
  <div>
    <div class="mb-8 flex justify-start max-w-3xl">
      <h1 class="font-bold text-3xl">
        <span class="text-indigo-400 font-medium">/</span>
        {{ form.name }}
      </h1>
    </div>
    <trashed-message v-if="user.deleted_at" class="mb-6" @restore="restore">
      This user has been deleted.
    </trashed-message>
    <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
      <form @submit.prevent="submit">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input v-model="form.name" :error="errors.name" class="pr-6 pb-8 w-full lg:w-1/2" label="Имя" />
          <text-input v-model="form.email" :error="errors.email" class="pr-6 pb-8 w-full lg:w-1/2" label="Email" />
          <text-input v-model="form.password_old" :error="errors.password_old" class="pr-6 pb-8 w-full lg:w-1/2" type="password" autocomplete="new-password" label="Старый пароль" />
          <text-input v-model="form.password_new" :error="errors.password_new" class="pr-6 pb-8 w-full lg:w-1/2" type="password" autocomplete="new-password" label="Новый пароль" />
        </div>
        <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex items-center">
          <button v-if="!user.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Удалить аккаунт</button>
          <loading-button :loading="sending" class="btn-blue ml-auto text-white border bg-blue-700 hover:bg-blue-500 py-3 px-8 font-bold rounded-lg" type="submit">Сохранить</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import LoadingButton from '@/Shared/LoadingButton'
import SelectInput from '@/Shared/SelectInput'
import TextInput from '@/Shared/TextInput'
import FileInput from '@/Shared/FileInput'
import TrashedMessage from '@/Shared/TrashedMessage'
import Vue from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';

Vue.use(VueSweetalert2);

export default {
  metaInfo() {
    return {
      title: `${this.form.name}`,
    }
  },
  layout: Layout,
  components: {
    LoadingButton,
    SelectInput,
    TextInput,
    FileInput,
    TrashedMessage,
  },
  props: {
    errors: Object,
    user: Object,
  },
  remember: 'form',
  data() {
    return {
      sending: false,
      form: {
        name: this.user.name,
        email: this.user.email,
        password_old: this.user.password_old,
        password_new: this.user.password_new,
      },
    }
  },
  methods: {
    submit() {
      var data = new FormData()
      data.append('name', this.form.name || '')
      data.append('email', this.form.email || '')
      data.append('password_old', this.form.password_old || '')
      data.append('password_new', this.form.password_new || '')
      data.append('_method', 'put')

      this.$inertia.post(this.route('profile.update'), data, {
        onStart: () => this.sending = true,
        onFinish: () => this.sending = false,
        onSuccess: () => {
          if (Object.keys(this.$page.errors).length === 0) {
            this.form.photo = null
            this.form.password = null
          }
        },
      })
    },
    destroy() {
      Vue.swal.fire({
      title: 'Вы уверены?',
      text: "Ваш аккаунт будет удален!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#2b6cb0',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Отмена',
      confirmButtonText: 'Да, удалить!'
      }).then((result) => {
      if (result.isConfirmed) {
        Vue.swal.fire(
          'Выполнено!',
          'Ваш аккаунт полностью удален!',
          'success'
        )
        this.$inertia.delete(this.route('profile.destroy'))
      }
    })
    },
  },
}
</script>

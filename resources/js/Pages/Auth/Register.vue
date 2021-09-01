<template>
  <div class="p-6 bg-indigo-800 min-h-screen flex justify-center items-center">
    <div class="w-full max-w-md">
      <logo class="block mx-auto w-full max-w-xs fill-white" height="50" />
      <form class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden" @submit.prevent="submit">
        <div class="px-10 py-12">
          <h1 class="text-center font-bold text-3xl">Регистрация</h1>
          <div class="mx-auto mt-6 w-24 border-b-2" />
          <text-input v-model="form.name" :error="errors.name" class="mt-10" label="Имя" type="text" />
          <text-input v-model="form.email" :error="errors.email" class="mt-10" label="Email" type="email" autofocus autocapitalize="off" />
          <text-input v-model="form.password" :error="errors.password" class="mt-6" label="Пароль" type="password" />
          <text-input v-model="form.password_confirmation" class="mt-6" label="Повторите пароль" type="password" />
        </div> 
        <div class="px-10 py-4 bg-gray-100 border-t border-gray-200 flex justify-between items-center">
          <inertia-link :href="route('login')">Вход</inertia-link>
          <loading-button :loading="sending" class="btn-indigo" type="submit">Регистрация</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import LoadingButton from '@/Shared/LoadingButton'
import Logo from '@/Shared/Logo'
import TextInput from '@/Shared/TextInput'

export default {
  metaInfo: { title: 'Регистрация' },
  components: {
    LoadingButton,
    Logo,
    TextInput,
  },
  props: {
    errors: Object,
  },
  data() {
    return {
      sending: false,
      form: {
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
      },
    }
  },
  methods: {
    submit() {
      const data = {
        name: this.form.name,
        email: this.form.email,
        password: this.form.password,
        password_confirmation: this.form.password_confirmation,
      }

      this.$inertia.post(this.route('register.post'), data, {
        onStart: () => this.sending = true,
        onFinish: () => this.sending = false,
      })
    },
  },
}
</script>

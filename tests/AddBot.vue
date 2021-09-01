<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">Мои боты</h1>

  
  <inertia-link :href="route('bot.create')">
    <button class="mr-5 bg-blue-700 text-white border border-blue-700 font-bold py-2 px-6 rounded-lg">
      Добавить бота</button>  
  </inertia-link>

<button @click="addBot()" class="mr-5 bg-blue-700 text-white border border-blue-700 font-bold py-2 px-6 rounded-lg">
      Добавить бота Modal</button>  


      
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import Vue from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';

Vue.use(VueSweetalert2);

export default {
  metaInfo: { title: 'Мои боты' },
  layout: Layout,
    methods: {

    addBot() {
      Vue.swal.fire({
        title: 'Введите токен бота',
        input: 'text',
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Добавить',
        cancelButtonText: 'Отмена',
        showLoaderOnConfirm: true,
        preConfirm: (token) => {
          return fetch(`//api.telegram.org/bot${token}/getMe`)
            .then(response => {
              if (!response.ok) {
                throw new Error("err")
              }
              response.json().then((data) => {
                if (data.result.id) {
                  this.$inertia.post(this.route('bot.store', token))
                }
              })
            })
            .catch(error => {
              Vue.swal.showValidationMessage(
                `Неверный токен!`
              )
            })
        },
        allowOutsideClick: () => !Vue.swal.isLoading()
      })
    },
  },  
}
</script>

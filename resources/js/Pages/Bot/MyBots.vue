<template>
  <div>
    <div class="grid grid-cols-6 gap-4">
      <div class="col-start-1 col-end-7">
        <h1 class="mb-8 pt-2 font-bold text-2xl">Мои боты</h1>
      </div>
      <div class="col-end-9 col-span-2">
        <button @click="createBot()" class="mr-7 bg-blue-700 text-white border hover:bg-blue-500 font-bold py-2 px-4 rounded-lg ">
          <div class="flex items-center"><icon name="plus" class="w-6 h-6 fill-white mt-1" /> <span>Добавить бота</span></div>
        </button>  
      </div>
    </div>


    <div v-if="bots.length" class="grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
      <div v-for="bot in bots" :key="bot.id" class="bg-white shadow p-4 rounded lg:w-64 text-xl">
        <div class="float-right cursor-pointer text-grey-dark hover:text-blue duration-4" @click="deleteBot(bot.id)">x</div>
        <div class="text-center mt-4">
          <p class="text-gray-600 font-bold">{{ bot.name }}</p>
          <p class="text-sm font-hairline text-gray-600 mt-1">@bot</p>
        </div>
        <div class="flex justify-center mt-4">
          <img class="shadow sm:w-12 sm:h-12 w-10 h-10 rounded-full" src="storage/images/bots/bot.jpg" alt="Avatar" />
        </div>
        <div class="mt-6 flex justify-between text-center">
          <div>
            <p class="text-gray-700 font-bold">0</p>
            <p class="text-xs mt-2 text-gray-600 font-hairline">Категорий</p>
          </div>
          <div>
            <p class="text-gray-700 font-bold">0</p>
            <p class="text-xs mt-2 text-gray-600 font-hairline">Товаров</p>
          </div>
          <div>
            <p class="text-gray-700 font-bold">0</p>
            <p class="text-xs mt-2 text-gray-700 font-hairline">Заказов</p>
          </div>
        </div>
        <div class="mt-6">
          <inertia-link :href="route('bot.index', bot.id)">
          <button class="rounded shadow-md w-full items-center shadow bg-blue-500 px-4 py-2 text-white hover:bg-blue-400">
            Управление ботом
          </button>
          </inertia-link>
        </div>
      </div>
    </div>


    <div v-else class="bg-white text-gray-700 rounded text-center">
      <div class="flex justify-center">
        <div class="bg-white rounded-full h-32 w-32 -mt-8 flex items-center justify-center">
          <icon name="empty" class="w-32 h-32" />
        </div>
      </div>
      <div class="mt-6">
        <h1 class="text-3xl text-blue-500 font-bold">
          Нет добавленных ботов
        </h1>
        <p class="mt-3 text-gray-600 text-xl font-serif">
            Добавьте свой первый бот
        </p>
        <button @click="createBot()" class="mt-8 mb-4 bg-blue-700 text-white border border-blue-700 font-bold py-3 px-8 rounded-lg">
          Добавить бота
        </button>
      </div>
    </div>

  </div>
</template>



<script>
import Layout from '@/Shared/Layout'
import Icon from '@/Shared/Icon'
import Vue from 'vue'

export default {
  metaInfo: { title: 'Мои боты' },
  layout: Layout,
  props: {
    bots: Array,
  },
  components: {
    Icon,
  },  
  methods: {
    createBot() {
      Vue.swal.fire({
        title: 'Введите название бота',
        input: 'text',
        showCancelButton: true,
        confirmButtonColor: '#2b6cb0',
        confirmButtonText: 'Добавить',
        cancelButtonText: 'Отмена',
        showLoaderOnConfirm: true,
        preConfirm: (name) => {
        if(name.length < 3) {
          Vue.swal.showValidationMessage( `Короткое название!` )
          return      
        }
        this.$inertia.post(this.route('bot.create'), {name: name} )
        },
        allowOutsideClick: () => !Vue.swal.isLoading()
      })
    },
    deleteBot(id) {
      Vue.swal.fire({
      title: 'Вы уверены?',
      text: "Бот будет полностью удален!",
      showCancelButton: true,
      confirmButtonColor: '#2b6cb0',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Отмена',
      confirmButtonText: 'Да, удалить!'
      }).then((result) => {
      if (result.isConfirmed) {
        this.$inertia.delete(this.route('bot.destroy', id))
      }
      })
    },  
  },  
}
</script>

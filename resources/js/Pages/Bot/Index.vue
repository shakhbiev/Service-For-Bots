<template>
  <div>
    
    <h2 class="mb-8 font-bold text-3xl">Бот: {{bot.name}}</h2>
  
  
    <div class="mt-4">
      <div class="flex flex-wrap -mx-4">
        <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
          <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
            <div class="p-3 rounded-full bg-indigo-600 bg-opacity-75">
              <icon name="users" class="w-12 h-12 fill-white" />
            </div>
            <div class="mx-5">
              <h4 class="text-2xl font-semibold text-gray-700">0</h4>
              <div class="text-gray-500">Пользователей</div>
            </div>
          </div>
        </div>
        <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
          <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
            <div class="p-3 rounded-full bg-orange-600 bg-opacity-75">
              <icon name="shopping-cart" class="w-12 h-12 fill-white" />
            </div>
            <div class="mx-5">
              <h4 class="text-2xl font-semibold text-gray-700">0</h4>
              <div class="text-gray-500">Заказов</div>
            </div>
          </div>
        </div>
        <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
          <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
            <div class="p-3 rounded-full bg-pink-600 bg-opacity-75">
              <icon name="printer" class="w-12 h-12 fill-white" />
            </div>
            <div class="mx-5">
              <h4 class="text-2xl font-semibold text-gray-700">0</h4>
              <div class="text-gray-500">Продуктов</div>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
</template>


<script>
import Layout from '@/Shared/Layout'
import Icon from '@/Shared/Icon'
import Vue from 'vue'

export default {
  metaInfo() {
    return {
      title: `${this.bot.name}`,
    }
  },
  layout: Layout,
  props: {
    bot: Object,
  },
  components: {
    Icon,
  },    
};
</script>

<template>
  <div>
    <div class="mb-4">
      <inertia-link :class="isUrl('') ? link_divs_1 : link_divs_2" :href="route('dashboard')">
        <icon name="bots" class="w-6 h-6 mr-2" :class="isUrl('') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('') ? 'text-white mx-2' : 'text-indigo-300 group-hover:text-white mx-2'">Мои боты</div>
      </inertia-link>
    </div><hr> 
    
    <div v-if="$page.bot">

      <div class="mb-4">
        <inertia-link :class="isUrl('index') ? link_divs_1 : link_divs_2" :href="route('bot.index', $page.bot.id )">
          <icon name="info" class="w-6 h-6 mr-2" :class="isUrl('index') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
          <span :class="isUrl('index') ? 'text-white mx-2' : 'text-indigo-300 group-hover:text-white mx-2'">Информация</span>
        </inertia-link>
      </div>
 
      <div class="mb-4">
        <inertia-link :class="isUrl('categories') ? link_divs_1 : link_divs_2" :href="route('categories', $page.bot.id )">
          <icon name="table" class="w-6 h-6 mr-2" :class="isUrl('categories') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
          <span :class="isUrl('categories') ? 'text-white mx-2' : 'text-indigo-300 group-hover:text-white mx-2'">Категории</span>
        </inertia-link>
      </div>

      <div class="mb-4">
        <inertia-link :class="isUrl('products') ? link_divs_1 : link_divs_2" :href="route('products', $page.bot.id )">
          <icon name="product" class="w-6 h-6 mr-2" :class="isUrl('products') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
          <span :class="isUrl('products') ? 'text-white mx-2' : 'text-indigo-300 group-hover:text-white mx-2'">Продукты</span>
        </inertia-link>
      </div>

    </div>
    <div class="mb-4 text-lg text-white" v-else>
      <div class="mb-4">
        <div class="flex items-center mt-4 py-4 px-6 border-l-4 border-indigo-400 bg-gray-600 bg-opacity-25 animate-pulse">
          Выберите бота <icon name="right" class="w-5 h-5 ml-3" />
        </div>
      </div>                    
    </div>


  </div>
</template>

<script>
import Icon from '@/Shared/Icon'

export default { 
  components: {
    Icon, 
  },
  props: {
    url: String,
  },
  methods: {
    isUrl(...urls) {
      if (urls[0] === '') 
        return this.url === ''
  
      let route = this.url.split("/")
      if(route[2] == urls[0]) 
        return urls.filter(url => route[2]).length

      // return urls.filter(url => this.url.endsWith(url)).length 
    },
  },
  data() {
    return {
      link_divs_1: 'flex items-center mt-4 py-4 px-6 border-l-4 bg-gray-600 bg-opacity-25 text-gray-100 border-gray-100',
      link_divs_2: 'flex items-center mt-4 py-4 px-6 border-l-4 border-indigo-400 text-gray-500 hover:bg-gray-600 hover:bg-opacity-25 hover:text-gray-100',
    }
  },
}
</script>

<template>
  <div>

    <div class="grid grid-cols-6 gap-4">

      <nav class="text-black font-bold mt-3 col-start-1 col-end-7" aria-label="Breadcrumb">
        <ol class="list-none p-0 inline-flex">
          <li class="flex items-center">
            <inertia-link :href="route('bot.index', bot.id )">{{ bot.name }}</inertia-link>
            <icon name="breadcrumb" class="fill-current w-3 h-3 mx-3 mt-1"/>
          </li>
          <li>
            <a class="text-gray-500" aria-current="page">Выберите категорию</a>
          </li>
        </ol>
      </nav>
    </div>

<div class="grid">
      <div v-if="categories.length" class="flex justify-center">
            <div class="bg-white shadow-xl rounded-lg w-1/2">
                <ul class="divide-y divide-gray-300">

                  <div v-for="cat in categories" :key="cat.id" >
                  <inertia-link :href="route('products.select',  [bot.id, cat.id])">
                    <li class="p-4 hover:bg-gray-50 cursor-pointer">
                    {{ cat.name }}
                    </li>
                  </inertia-link> 
                  
                  </div>
                </ul>
            </div>
        </div>

             
            <div v-else class="w-full mx-auto bg-red-200 px-6 py-4 mx-2 my-4 rounded-md text-lg flex items-center ml-5">
              <icon name="views-list" class="w-6 h-6 mr-2" />
              <span class="text-red-800"> Вы не добавили ни один товар </span>
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
      title: `Категории: ${this.bot.name}`,
    }
  },
  components: {
    Icon,
  },
  layout: Layout,
  props: {
    bot: Object,
    categories: Array,
  },
  data() {
    return {
      open: false,
    }
  },  
  methods: {
    createCategory() {
      Vue.swal.fire({
        title: 'Создаем категорию',
        input: 'text',
        showCancelButton: true,
        confirmButtonColor: '#2b6cb0',
        confirmButtonText: 'Добавить',
        cancelButtonText: 'Отмена',
        inputPlaceholder: 'Введите название',
        showLoaderOnConfirm: true,
        preConfirm: (name) => {
        if(name.length < 3) {
          Vue.swal.showValidationMessage( `Короткое название!` )
          return      
        }
        this.$inertia.post(this.route('category.create', this.bot.id), {name: name} )
        },
        allowOutsideClick: () => !Vue.swal.isLoading()
      })
    },
    deleteCategory(id) {
      Vue.swal.fire({
      title: 'Вы уверены?',
      text: "Категория будет полностью удалена!",
      showCancelButton: true,
      confirmButtonColor: '#2b6cb0',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Отмена',
      confirmButtonText: 'Да, удалить!'
      }).then((result) => {
      if (result.isConfirmed) {
        this.$inertia.delete(this.route('category.destroy', id))
      }
      })
    },  
  },    
};
</script>

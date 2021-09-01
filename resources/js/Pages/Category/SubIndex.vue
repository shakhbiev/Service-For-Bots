<template>
  <div>

    <div class="grid grid-cols-6 gap-4">

      <nav class="text-black font-bold mt-3 col-start-1 col-end-7" aria-label="Breadcrumb">
        <ol class="list-none p-0 inline-flex">
          <li class="flex items-center">
            <inertia-link :href="route('categories', bot.id )">Категории</inertia-link>
            <icon name="breadcrumb" class="fill-current w-3 h-3 mx-3 mt-1"/>
          </li>
          <li>
            <a class="text-gray-500" aria-current="page">{{ category.name }}</a>
          </li>
        </ol>
      </nav>

      <div class="col-end-9 col-span-2">
        <button @click="createSubCategory()" class="mr-7 bg-blue-700 text-white border hover:bg-blue-500 font-bold py-2 px-4 rounded-lg ">
           Создать подкатегорию</button>  
      </div>
    </div>
           
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
            <table class="bg-white min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Подкатегория
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Управление
                        </th>

                    </tr>
                </thead>
                <tbody>                   
                    <tr>
                        <td class="px-5 py-3 border-b border-gray-200 bg-white text-sm">
                            <div class="flex items-center">
                                <div class="ml-3">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        <inertia-link v-if="!category.category_id" :href="route('categories',  [bot.id])">
                                          <button class="flex px-8 py-2 text-blue-600 hover:shadow-md">
                                            <icon name="left" class="w-6 h-6" />  Назад
                                          </button>
                                        </inertia-link>
                                        <inertia-link v-else :href="route('subcategories',  [bot.id, category.category_id])">
                                          <button class="flex px-8 py-2 text-blue-600 hover:shadow-md">
                                            <icon name="left" class="w-6 h-6" />  Назад
                                          </button>
                                        </inertia-link>                                        
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3 border-b border-gray-200 bg-white text-sm"></td>
                    </tr>                                               
                </tbody>                
                <tbody v-if="subcategories.length">                   
                    <tr v-for="subcat in subcategories" :key="subcat.id">
                        <td class="px-5 py-3 border-b border-gray-200 bg-white text-xl">
                            <div class="flex items-center">
                                <div class="ml-3"> 
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        <inertia-link :href="route('subcategories',  [bot.id, subcat.id])">
                                          <button class="px-8 py-2 border text-blue-600 hover:shadow-md">{{ subcat.name }}</button>
                                        </inertia-link>
                                    </p>
                                </div>
			
                            </div>
                        </td>
                        <td class="px-5 py-3 border-b border-gray-200 bg-white text-sm">
                          <button type="button" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline"><icon name="edit" class="w-4 h-4"/></button>
                          <button type="button" @click="deleteSubCategory(subcat.id)" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline"><icon name="delete" class="w-4 h-4"/></button>
                        </td>
                    </tr>                                               
                </tbody>
                <div v-else class="w-full mx-auto bg-red-200 px-6 py-4 mx-2 my-4 rounded-md text-lg flex items-center ml-5">
                  <icon name="views-list" class="w-6 h-6 mr-2" />
                  <span class="text-red-800"> Нет подкатегорий </span>
                </div>                 
            </table>
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
    subcategories: Array,
    category: Object,
  },
  methods: {
    createSubCategory() {
      Vue.swal.fire({
        title: 'Создаем подкатегорию',
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
        this.$inertia.post(this.route('subcategory.create', [this.bot.id, this.category.id]), {name: name} )
        },
        allowOutsideClick: () => !Vue.swal.isLoading()
      })
    },
    deleteSubCategory(id) {
      Vue.swal.fire({
      title: 'Вы уверены?',
      text: "Подкатегория будет полностью удалена!",
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

<template>
  <div>

    <div v-if="$page.flash.success">
        {{ this.showAlert('success', $page.flash.success) }}
    </div>   

    <div v-if="$page.flash.success_big">
        {{ this.showAlert('success', $page.flash.success_big, false) }}
    </div>   

    <div v-if="$page.flash.error">
        {{ this.showAlert('error', $page.flash.error) }}
    </div> 

    <div v-if="Object.keys($page.errors).length > 0">
        {{ this.showErrors(Object.values($page.errors)) }}
    </div>

  </div>
</template>

<script>
import Vue from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';

Vue.use(VueSweetalert2);

export default {
  watch: {
    '$page.flash': {
      handler() {
      },
      deep: true,
    },
  },
  methods: {
    showAlert(type, text, toast=true) {
      Vue.swal.fire({
        position: 'center',
        icon: type,
        toast: toast,
        title: text,
        showConfirmButton: false,
        timer: 1000
      })
    },  
    showErrors(array) {
      var errors = ''
      for (let i = 0; i < array.length; i++) { 
        errors += '<li>'+array[i]+'</li>'
      }
      Vue.swal.fire({
        icon: 'error',
        html: errors
      })
    },      
},  

}
</script>

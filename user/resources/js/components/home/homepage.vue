<template>
<div class="">
    <b-overlay class="position-fixed w-100 h-100" :show="showOverlay" no-wrap spinner-variant="primary" rounded="sm" spinner-type="border" z-index="999999" />
      <notification :alertTitle="alertTitle" :alertMsg="alertMsg" />        
<div class="container-fluid m-0 p-0">
    <a href="#" id="topLink"></a>
      <div class="">

<titles />
<single-slide-show />
<div class="container mb-5">
</div>


<menu-footer />

</div>
</template>

<script>
import appsettings from '../json/myapp.json'
export default {
  name: 'home',
    data (){
    return{
        alertTitle: '',
        alertMsg: '',
        showOverlay: false,
        notification: '',
        info: [],
        progress: null,
        record:false,
        responseStatus: '',
        errors: [],
        settings:appsettings.settings,
    }
    },

    created(){
    }, 
    methods:{
    },


    }
</script>
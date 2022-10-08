<template>
<div class="mb-3">
    <b-overlay class="position-fixed w-100 h-100" :show="showOverlay" no-wrap spinner-variant="primary" rounded="sm" spinner-type="border" z-index="999999" />
      <notification :alertTitle="alertTitle" :alertMsg="alertMsg" /> 
<div class="container-fluid m-0 p-0 shadow-sm menuheader border-bottom borderStyle">
    <a href="#" id="topLink"></a>
  <div class="">
<div class="row">
<div class="col-md-12">
<nav class="navbar navbar-expand-lg">
<span class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<i class="bi bi-list" style="font-size: 2rem; color: black;"></i>
</span>
<a class="navbar-brand p-0 m-0 me-3 ms-md-2 text-success" style="color:#f8b818;" href="/"><img :src="settings.logo" class="menuLogo rounded" alt="logo"> &nbsp; <span v-html="settings.appname"></span> </a>
<ul class="navbar-nav p-0 m-3 mb-0 mt-0 d-md-none">
    <li class="nav-item"> <a href="/contactus" class="text-dark"> <i class="bi bi-question-circle" role="img" aria-label="Help" style="font-size: 1.6rem;"></i> <span class="d-md-none"></span>  </a>  </li>
</ul>
<div class="collapse navbar-collapse" id="navbar">
<div class="pb-1 mt-2 menudivider"></div>
    <ul class="navbar-nav m-0 p-0 ms-auto">
        <li class="nav-item m-3 mb-md-0 mt-md-0 me-md-3 pt-2" v-for="(d, index) in menus" :key="index"> <a href="/"  class="text-dark" v-html="d.title"></a> </li>
    </ul>
    <ul class="navbar-nav m-0 p-0 ms-auto">
        <li class="nav-item m-3 mb-md-0 mt-md-0 me-md-3 pt-1"> <a href="/signin"  class="btn btn-primary"> Sign in </a> </li>
    </ul>
</div>
</nav>
</div>
</div>
</div>

<!-- footer -->
</div>
</div>
</template>


<script>
import appsettings from '../../json/myapp.json'
export default {
  name: "menu_header",
  props: ['server_message'],
        data(){
        return {
        alertTitle: '',
        alertMsg: '',
        showOverlay: false,
        notification: '',
        info: [],
        progress: null,
        btntxt: 'Log in',
        button: 'Log in',
        record: false,
        errors: [],
        settings: appsettings.settings,
        menus: [
        ]
        }
        },

        mounted(){
        
        },
        methods:{
               
        },

}
</script>
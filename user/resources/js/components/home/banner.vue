<template>
<div class="">
    <b-overlay class="position-fixed w-100 h-100" :show="showOverlay" no-wrap spinner-variant="primary" rounded="sm" spinner-type="border" z-index="999999" />
      <notification :alertTitle="alertTitle" :alertMsg="alertMsg" />        
<div class="container-fluid m-0 p-0">
    <div class="row p-0 m-0">
    <div class="col m-0 p-0">
       <a href="/app/pos/portal">   <img src="/assets/images/banner.gif" class="w-100 img-fluid" style="height:640px;" alt="Image loading..."> </a>
    </div>
        </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'banner',
    data (){
    return{
    alertTitle: '',
    alertMsg: '',
    showOverlay: false,
      slides: [
                {'img': '', 'title': '', 'tag':'', 'description': '', 'link': '', 'content': '', 'btntxt': ''},
                {'img': '', 'title': '', 'tag':'', 'description': '', 'link': '', 'content': '', 'btntxt': ''},

                ],
    }
    }
}
</script>
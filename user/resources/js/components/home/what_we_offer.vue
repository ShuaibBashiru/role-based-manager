<template>
<div class="">
    <b-overlay class="position-fixed w-100 h-100" :show="showOverlay" no-wrap spinner-variant="primary" rounded="sm" spinner-type="border" z-index="999999" />
      <notification :alertTitle="alertTitle" :alertMsg="alertMsg" />        
<div class="container-fluid m-0 p-0">
    <a href="#" id="topLink"></a>
      <div class="">
    <div class="container-fluid p-1 p-md-2">
<div class="row d-flex justify-content-center">
  <div class="col-md-12 mt-3 mb-3">
         <h3 class="pb-2 text-center text-dark"><strong>What we offer!</strong></h3>
         <p class="text-center"></p>
  </div>
  </div>

<div class="row">
<div class="col-md-4" v-for="(d, index) in whatWeOffer" :key="index">
    <div class="m-2">
    <div class="card mt-2 m-auto" style="">
        <div class="row m-0 pt-3">
          <div class="col-md-4 p-2 text-center"> <img :src="d.img" class="card-img-top" style="width:96px; height:96px;" alt="..."></div>
  <div class="col-md-8">
     <div class="card-body">
    <h6 class="card-title text-dark"><strong>{{d.title}}</strong></h6>
    <p class="card-text">{{d.description}}</p>
    <a :href="d.link" class="text-primary">{{d.linkText}}</a>
  </div>
  </div>
  </div>
</div>
</div>
</div>

</div>
</div>
    </div>
    </div>
    </div>
</template>
<script>
export default {
    name: 'whatweoffer',
    data (){
    return{
        alertTitle: '',
        alertMsg: '',
        showOverlay: false,
        whatWeOffer:[
          {'id': 1, 'title':'Secure savings', 'tag':'', 'description':'Registered members can make a secure savings.', 'img':'/assets/icons/saving.jpeg', 'link':'/signin', 'linkText':'Log in to continue', 'content':'', 'icon':'', 'target':''},
          {'id': 2, 'title':'0% interest Loans', 'tag':'', 'description':'The society offers its members Loan with 0% Interest rate.', 'img':'/assets/icons/loan.png', 'link':'/signin', 'linkText':'Log in to continue', 'content':'', 'icon':'', 'target':''},
          {'id': 3, 'title':'Goods and Commodity', 'tag':'', 'description':'Registered members can purchase goods and commodity.', 'img':'/assets/icons/exchange.png', 'link':'/signin', 'linkText':'Check out', 'content':'', 'icon':'', 'target':''}
        ],

    }
    }
}
</script>
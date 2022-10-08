<template>
<div class="">
    <b-overlay class="position-fixed w-100 h-100" :show="showOverlay" no-wrap spinner-variant="primary" rounded="sm" spinner-type="border" z-index="999999" />
      <notification :alertTitle="alertTitle" :alertMsg="alertMsg" />        
<div class="container-fluid m-0 p-0">
    <a href="#" id="topLink"></a>
      <div class="">
    <div class="container-fluid p-1 p-md-2 bg-light">
<div class="row">
  <div class="col-md-12 mt-3 mb-3">
         <h3 class="pb-2 text-center text-dark"><strong>Structure</strong></h3>
         <p class="text-center">Yabatech Prestige Cooperative provides the below structure for its members</p>
  </div>
  </div>

<div class="row">
<div class="col-md-4" v-for="(d, index) in loanStructure" :key="index">
    <div class="m-2">
    <div class="card mt-2 m-auto" style="">
       <div :class="'card-header p-2 border-bottom-0 text-center '+ d.headerColor "><strong>{{d.title}}</strong></div>
        <div class="row m-0">
  <div class="col-md-12">
      <div class="card-body">
     <ul class="list-group list-group-flush">
    <li class="list-group-item" v-for="(d2, index) in d.info" :key="index">{{d2}}</li>
  </ul>
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
    name: 'structure',
    data (){
    return{
    alertTitle: '',
    alertMsg: '',
    showOverlay: false,
        loanStructure:[
          {'id': 1, 'info': ['Ordinary Savings', 'Share Capital Fund', 'Target Savings'], 'title':'Savings', 'tag':'', 'description':'', 'img':'', 'link':'', 'linkText':'', 'content':'', 'icon':'', 'target':'', 'headerColor':'text-white bg-primary'},
          {'id': 2, 'info': ['Normal Loan', 'Emergency Loan', 'Token', 'Textbooks Loan'], 'title':'Loans', 'tag':'', 'description':'', 'img':'', 'link':'', 'linkText':'', 'content':'', 'icon':'', 'target':'', 'headerColor':'text-white bg-warning'},
          {'id': 3, 'info': ['Food Items', 'Electronics', 'Kitchen utencils', 'Furniture & fittings', 'Refrigerator'], 'title':'Goods and Commodity', 'tag':'', 'description':'', 'img':'', 'link':'', 'linkText':'', 'content':'', 'icon':'', 'target':'', 'headerColor':'text-white bg-primary'}
          ],
    }
    }
}
</script>
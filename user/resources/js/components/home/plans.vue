<template>
<div class="">
    <b-overlay class="position-fixed w-100 h-100" :show="showOverlay" no-wrap spinner-variant="primary" rounded="sm" spinner-type="border" z-index="999999" />
      <notification :alertTitle="alertTitle" :alertMsg="alertMsg" />        
<div class="container-fluid m-0 p-0">
    <a href="#" id="topLink"></a>
      <div class="">
    <div class="container-fluid p-1 p-md-2">
  <div class="row">
  <div class="col-md-12 mt-3 mb-3">
         <h3 class="pb-2 text-center text-dark"><strong>Loan Plans</strong></h3>
  </div>
  </div>

<div class="row">
<div class="col-md-3" v-for="(d, index) in loanPlans" :key="index">
  <div class="m-1">
    <div class="card mt-2 m-auto" style="">
        <div class="row m-0">
        <div class="col-2 text-center pt-1">
            <i :class="d.icon" style="font-size: 2rem;"></i>
          </div>
  <div class="col-10">
     <div class="card-body">
    <p class="card-text" v-text="d.title"></p>
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
    name: 'plans',
    data (){
    return{
    alertTitle: '',
    alertMsg: '',
    showOverlay: false,
        loanPlans:[
          {'id': 1, 'title':'Two (2) Months', 'tag':'', 'description':'', 'img':'', 'link':'', 'linkText':'', 'content':'', 'icon':'bi-check-square text-primary', 'target':''},
          {'id': 2, 'title':'Four (4) Months', 'tag':'', 'description':'', 'img':'', 'link':'', 'linkText':'', 'content':'', 'icon':'bi-check-square text-warning', 'target':''},
          {'id': 3, 'title':'Six (6) Months', 'tag':'', 'description':'', 'img':'', 'link':'', 'linkText':'', 'content':'', 'icon':'bi-check-square text-primary', 'target':''},
          {'id': 4, 'title':'Twelve (12) Months', 'tag':'', 'description':'', 'img':'', 'link':'', 'linkText':'', 'content':'', 'icon':'bi-check-square text-warning', 'target':''},
        ],
    }
    }
}
</script>
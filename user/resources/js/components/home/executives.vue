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
         <h3 class="pb-2 text-center text-dark"><strong>Meet the executive members</strong></h3>
         <p class="text-center"></p>
  </div>
</div>
<div class="row m-0 d-flex justify-content-center">
  <Vslick v-bind="itemscroll">
<div class="col-md-4" v-for="(d, index) in members" :key="index">
  <div class="m-2">
    <div class="card mt-2 m-auto border-0 rounded pt-5 pb-3" style="background: #eee;">
        <div class="row m-0">
          <div class="col-md-12 p-2 text-center"> 
            <div class="imgwrapper rounded-circle m-auto">
              <img :src="d.img" class="card-img-top m-auto img-responsive rounded-circle" alt="Image">
            </div>
            </div>
  <div class="col-md-12">
     <div class="card-body text-center">
    <h4 class="card-title text-dark"><strong v-text="d.title"></strong></h4>
    <p class="lead card-text" v-text="d.tag"></p>
  </div>
  </div>
  </div>
</div>
</div>
</div>

</Vslick>
</div>
</div>
</div>
</div>
    </div>
</template>
<style>
.slick-slide img {
    width: 60%;
    border: 0px solid #fff
}

</style>
<script>
import Vslick from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
export default {
  name: 'executive',
      components:{
        Vslick
    },
    data (){
    return{
    alertTitle: '',
    alertMsg: '',
    showOverlay: false,
    members:[
          {'id': 1, 'title':'Dr Babajide M.O', 'tag':'Chairman', 'description':'', 'img':'/assets/executive/1.jpg', 'link':'', 'linkText':'', 'content':'', 'icon':'', 'target':''},
          {'id': 2, 'title':'Dr Babajide M.O', 'tag':'Financial director', 'description':'', 'img':'/assets/executive/2.jpg', 'link':'', 'linkText':'', 'content':'', 'icon':'', 'target':''},
          {'id': 3, 'title':'Dr Babajide M.O', 'tag':'Secretry', 'description':'', 'img':'/assets/executive/3.jpg', 'link':'', 'linkText':'', 'content':'', 'icon':'', 'target':''},
          {'id': 4, 'title':'Dr Babajide M.O', 'tag':'Auditor', 'description':'', 'img':'/assets/executive/3.jpg', 'link':'', 'linkText':'', 'content':'', 'icon':'', 'target':''},
        ],

    itemscroll:{
            arrows: true,
            dots: true,
            rows:1,
            slidesToShow:3,
            slidesToScroll:1,
            swipe:true,
            swipeToSlide:true,
            useCSS:true,
            autoplay:true,
            centerMode:true,
            centerPadding:'10',
            responsive: [
        {
            breakpoint: 1024,
            settings: {
            slidesToShow: 3,
            slidesToScroll: 2
            }
        },

        {
            breakpoint: 767,
            settings: {
            slidesToShow: 2,
            slidesToScroll: 2
            }
        },
        {
            breakpoint: 639,
            settings: {
            slidesToShow: 1,
            slidesToScroll: 1
            }
        },
        ]
            // slidesPerRow:4,
            },
    }
    }
}
</script>
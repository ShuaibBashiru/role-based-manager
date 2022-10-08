<template>
<div class="">
    <b-overlay class="position-fixed w-100 h-100" :show="showOverlay" no-wrap spinner-variant="primary" rounded="sm" spinner-type="border" z-index="999999" />
      <notification :alertTitle="alertTitle" :alertMsg="alertMsg" />        
<div class="container-fluid m-0 p-0">
    <a href="#" id="topLink"></a>
      <div class="">
    <div class="container-fluid p-1 p-md-2 bg-light">
    <div class="row mt-0 pt-0">
    <div class="col m-0 p-0">
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <section v-if="slides.length>1">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <span v-for="(d, index) in slides" :key="index">
      <button type="button" data-bs-target="#carouselExampleCaptions" :data-bs-slide-to="index+1" :aria-label="'Slide '+index+1"></button>
      </span>
    </section>
     </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="row m-0">
        <div class="col-md-12 ps-md-4 pt-1 pt-md-0">
          <img src="/assets/images/banner.jpg" class="d-block w-100 img-fluid" style="" alt="...">
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
    name: 'singleslideshow',
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
<template>
<div class="bg-dark">
    <b-overlay class="position-fixed w-100 h-100" :show="showOverlay" no-wrap spinner-variant="primary" rounded="sm" spinner-type="border" z-index="999999" />
      <notification :alertTitle="alertTitle" :alertMsg="alertMsg" />        
<div class="container-fluid m-0 p-0">
    <a href="#" id="topLink"></a>
      <div class="">
    <div class="container-fluid p-1 p-md-2 bg-light">
        <div class="row">
          <div class="col">
        <p class="lead text-success text-center pt-1" v-text="settings.headerTitle"></p>
          </div>
        </div>
      </div>

    </div>
    </div>
    </div>
</template>
<script>
import appsettings from '../json/myapp.json'
export default {
    name: 'titleheader',
    data() {
        return {
            alertTitle: '',
            alertMsg: '',
            showOverlay: false,
            settings: appsettings.settings,
        }
    },
}
</script>
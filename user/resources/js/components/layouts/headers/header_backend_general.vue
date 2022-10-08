<template>
<div class="">
<b-overlay class="position-fixed w-100 h-100" :show="showOverlay" no-wrap spinner-variant="primary" rounded="sm" spinner-type="border" z-index="999999" />
<flyout-backend-menu />
<div class="container-fluid border-bottom menuheader shadow-sm p-0 pb-1 pt-1 m-0 p-0">
<div class="row p-0 m-0">
<div id="" class="col-md-2 col-3 m-0 p-0">
<nav class="navbar navbar-expand-lg p-0 m-0 ps-2 pb-1">
  <ul class="nav p-0 w-100">
        <li class="nav-item w-100"> <a class="navbar-brand siteStyle p-0 m-0" href="/app/dashboard">
        <img :src="settings.logo" :style="'width:'+settings.logoHeight +' '+'height:'+settings.logoWidth" class="menuLogo rounded"  alt="logo"> <span v-text="settings.logoname" class=""></span> </a>  <i class="bi bi-list float-end d-none d-md-block" id="toggleHideBtn" style="font-size: 1.6rem; color: black;"></i> </li>
  </ul>
</nav>
</div>

<div class="col m-0 p-0">
<nav class="navbar navbar-expand-lg p-0 m-0 me-2">
<ul class="nav">
</ul>
<ul class="nav m-0 p-0 ms-auto align-items-center dropstart">
        <li class="nav-item"><a href="#" class="nav-link p-1 pe-2"><i class="bi bi-bell fs-4"></i></a></li>
        <li class="nav-item p-1 pe-2 text-capitalize"> <span v-text="displayName"></span> </li>
        <li class="nav-item dropdown"><a href="#" data-bs-toggle="dropdown" role="button" aria-expanded="false" id="profileDrop" class="nav-link p-1 pe-1"><div class="dp-small"><img :src="userProfilePassport" alt=""></div></a>
         <ul class="dropdown-menu dropdown-menu-dark pt-3 pb-3" style="width:310px !important;" aria-labelledby="profileDrop" onclick="event.stopPropagation()">
            <li class="p-2">
                 <div class="text-center">
                     <figure>
                     <img :src="userProfilePassport" class="rounded-circle" style="width:90px; height:90x;" alt="Passport">
                    </figure>
                    <p class="m-0 p-1 mb-1"><span v-text="usersession['lastname'] + ' ' + usersession['firstname'] +' '+ usersession['othername']"></span></p>
                    <p class="m-0 p-1 text-muted fs-6 border border-secondary rounded rounded-pill"><span v-text="usersession['email_one']"></span></p>
                </div>
            </li>
            <hr />
            <li class="p-2"><a class="dropdown-item" href="/app/account/profile"><i class="bi bi-person"></i> My Profile</a></li>
            <li class="p-2"><a class="dropdown-item" :href="'/app/account/manage/'+usersession['generated_id']"><i class="bi bi-gear"></i> Manage Account </a></li>
            <hr />
            <li class="text-center p-2"><a class="dropdown-item border border-secondary rounded rounded-pill" href="/app/logout"><i class="bi bi-power border-secondary rounded rounded-pill"></i> Log Out </a></li>
          </ul>
        </li>
        <li class="nav-item d-md-none" data-bs-toggle="offcanvas" data-bs-target="#sideBarFlyout" aria-controls="sideBarFlyout"> <a href="#" class="nav-link p-1 pe-0"><i class="bi bi-list text-primary" style="font-size: 1.6rem; color: black;"></i></a></li>

</ul>

</nav>


</div>
</div>
</div>
</div>
</template>

<script>
import appsettings from '../../json/myapp.json'
export default {
    name: 'backend_header',
    data(){
        return {
        settings: appsettings.settings,
        alertTitle: '',
        alertMsg: '',
        showOverlay: false,
        notification: '',
        info: [],
        progress: null,
        btntxt: 'Log in',
        button: 'Log in',
        record:false,
        responseStatus: '',
        errors: [],
        usersession: [],
        displayName: '',
        changes: '',
        userProfilePassport: '/assets/passports/avatar.png',
        sidebarMenu: [
        ],
     
        }
        },

  created(){
     this.getSessionData();
     this.sessionActivity();
      this.userProfilePassport = this.usersession['file_url'] ? this.usersession['file_url'] : this.userProfilePassport;
    },
    mounted(){
    this.userRecord();
    },
  methods:{
    toggleMenu: function(){
      if (this.hideMenu == "d-none") {
            this.hideMenu = "";
      }else{
            this.hideMenu = "d-none";
      }
    },
    userRecord: function(){
      var initial = this.usersession['firstname'] ? this.usersession['firstname'].charAt(0) : 'Timed out'
      var name =  this.usersession['lastname'] ? this.usersession['lastname'] : '';
      this.displayName = name + ' ' + initial;

    },
     getSessionData: function(){
       try {
         if (this.$session.get('usersession')!=undefined && this.$session.get('usersession')!='') {
            this.usersession = this.$session.get('usersession')
         }else{
            window.location.href='/app/logout?msg=something went wrong'
         }
          } catch (error) {
              window.location.href='/app/logout?msg=something went wrong'

          }
    },
    sessionActivity: function(){
      setInterval(function(){
      try {
      if(document.cookie.split(';').some((item)=>item.trim().startsWith('usercookie='))){
          return true;
      }else{
            window.location.href='/app/logout?msg=session expired'
          }
    } catch (error) {
            window.location.href='/app/logout?msg=something went wrong'
          }
      },3000)

        },
    }

}
</script>
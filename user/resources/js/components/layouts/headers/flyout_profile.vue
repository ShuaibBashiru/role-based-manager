<template>
<div class="">
<b-overlay class="position-fixed w-100 h-100" :show="showOverlay" no-wrap spinner-variant="primary" rounded="sm" spinner-type="border" z-index="999999" />
<div class="offcanvas offcanvas-end" tabindex="0" id="sideBarFlyout" aria-labelledby="sideBarFlyoutLabel">
<div class="offcanvas-header">
    <h5 class="offcanvas-title" id="sideBarFlyoutLabel">Your Profile</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body">
    <div>
      Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
    </div>
</div>
</div>

</div>
</template>

<script>
import appsettings from '../../json/myapp.json'
export default {
    name: 'flyout_profile',
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
        changes: '',
        profilePic: '/assets/passports/avatar.png',
        sidebarMenu: [
        
        ],
     
        }
        },

  created(){
     this.getSessionData();
     this.sessionActivity();
    },

  methods:{
    toggleMenu: function(){
      if (this.hideMenu == "d-none") {
            this.hideMenu = "";
      }else{
            this.hideMenu = "d-none";
      }
    },
     getSessionData: function(){
       try {
         if (this.$session.get('usersession')!=undefined && this.$session.get('usersession')!='') {
            this.usersession = this.$session.get('usersession')
         }else{
            this.alertMsg='Something went wrong! Please log out and log in again to continue.'
            $("#alertDanger").toast('show')
         }
          } catch (error) {
            this.alertMsg='Error connecting! Please log out and log in again to continue.'
            $("#alertDanger").toast('show')

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
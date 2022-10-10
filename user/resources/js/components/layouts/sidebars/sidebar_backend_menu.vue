<template>
<div class="">
        <div class="container-fluid">
        <div class="row">
        <div id="togglePanel_1" class="col-2 mt-5 sidebar border-end p-0">
        <div class="wrapper pt-1">
        <div class="row p-3 ps-2">
        <div class="col-md-12">
        <!-- <div class="border-bottom mb-3"></div> -->
        <section v-for="(d, index) in menuList" :key="index">
         <div class="row">
          <div class="col-2" role="button"><i :class="d.icon+' me-1 ms-2'"></i></div>
          <div class="col-10 toggleHide" role="button"> <p data-bs-toggle="collapse" :data-bs-target="'#c'+d.id" aria-expanded="false"> <span v-text="d.title" class=""></span> <i class="bi bi-chevron-down float-end"></i> </p></div>
            <div class="collapse toggleHide" :id="'c'+d.id">
            <ul class="btn-toggle-nav list-unstyled fw-normal p-0 m-0 small" v-for="(d, index) in d.info" :key="index">
            <li class="p-0 m-0"> <a class="link-dark nav-link" :href="'/'+d.linkName" :target="d.link_target"><i class="bi bi-link"></i> <span v-text="d.menuName"></span>  </a></li>
            </ul>
            </div>
          </div>
        <div class="border-bottom mb-3"></div>
        </section>

        <div class="row">
          <div class="col-2" role="button"><i class="bi bi-power me-1 ms-2"></i></div>
          <div class="col-10 toggleHide" role="button"> <p> <a class="text-danger" href="/app/logout"> Log out </a>  </p></div>
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
import appsettings from '../../json/myapp.json'
export default {
    name: 'sidebar_backend',
    data(){
        return {
        hideMenu: '',
        alertTitle: '',
        alertMsg: '',
        showOverlay: false,
        notification: '',
        info: [],
        progress: null,
        btntxt: '',
        button: '',
        record:false,
        responseStatus: '',
        errors: [],
        usersession: [],
        settings: appsettings.settings,
        changes: '',
        menuList: [],
        sidebarMenu: [
          // Sample
          {'id': 1, 'title':'Account', 'info': [{'id':2, 'menuName': 'My profile', 'linkName': 'account/profile'}, {'id':2, 'menuName': 'Sign out', 'linkName': 'logout'}], 'tag':'', 'description':'', 'img':'', 'link':'', 'linkText':'', 'content':'', 'icon':'bi bi-person-circle', 'target':''},
        ],
     
        }
        },

  created(){
     this.getSessionData();
     this.getMenus();

    },

  methods:{
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

     getMenus: function(){
            $(".toaster").toast('hide')
            this.showOverlay=true;
            axios.get('/adminmenu/menulist', {params:this.parameters}).then(response => {
                this.showOverlay=false;
                this.errors = '';
                if(response.status != undefined && response.status==200 && response['data'].data.status=='success'){
                this.menuList = response['data'].data.info
                this.sortMenus();
                }else if(response['data'].data.status=='norecord'){
                this.menuList = ''
                }else{
                this.alertMsg='';
                }
            }).catch(error => {
                this.showOverlay=false;
                this.alertMsg=''
            })
        },
        
        sortMenus: function(){
        const menu_group = _.groupBy(this.menuList, menuList => menuList.group_name);
        var menuList = [];
        var counter = 0;
        for(var key in menu_group){
          counter += 1;
          var subList = [];
          let group_icon = '';
          for(let i=0; i < menu_group[key].length; i++){
            group_icon = menu_group[key][i].group_icon;
            if (menu_group[key][i].group_name===key) {
            var temPSubList = [{'id':i, 'menuName': menu_group[key][i].menu_title, 
            'linkName': menu_group[key][i].routeLink, 'target': menu_group[key][i].link_target}]
            subList.push(temPSubList[0])
            }
          }
          var list = [{'id': counter, 'title': key, 'info': subList, 'icon': group_icon}]
          menuList.push(list[0]);
          subList = [];
          this.menuList = menuList

          }

        },

    }

}
</script>
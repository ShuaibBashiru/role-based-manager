<template>
<div class="position-absolute w-100 h-100">
    <b-overlay class="position-fixed w-100 h-100" :show="showOverlay" no-wrap spinner-variant="primary" rounded="sm" spinner-type="border" z-index="999999" />

   <div class="container-fluid">
       <div class="row mt-5">
           <div class="col text-center">
               <p class="lead text-primary"><small><strong>{{message}}</strong></small></p>
           </div>
       </div>
   </div>

    </div>
</template>
<script>
export default {
    name: 'account_logout',
    props: ['server_message'],
data(){
    return{
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
        message: 'Please wait a moment while we are checking and validating authentication...',
   
    }
},

created(){
  this.logout()
},
    methods:{
    logout: function(){
        try {
        this.$session.destroy()
        $(".toaster").toast('hide')
        this.showOverlay=true;
        setTimeout(function(){
        window.location.href='/signin'
        },1000)
        } catch (error) {
        this.$session.destroy()
        $(".toaster").toast('hide')
        this.showOverlay=true;
        setTimeout(function(){
        window.location.href='/signin'
        },1000)
        }

        }
    },

}
</script>
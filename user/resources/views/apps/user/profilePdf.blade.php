<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<title>{{$data['title']}} For {{$data['user_info']['lastname'].'-'.$data['user_info']['firstname'].'-'.$data['dated']}}</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }
        @page { 
            margin: 5px;
            margin-left:12px;
            margin-right:12px;
        }
        body { 
            margin: 5px;
            margin-left:12px;
            margin-right:12px; 
        }
        .page-break {
            page-break-after: always;
        }
        .app{
            width:70%;
            margin: auto;
            height: auto;
        }
        .row{
            width: 100%;
            height: auto;
            padding: 3px;
        }
        .account-picture{
            height: 160px;
        }
        .list-group{
            width: 100%;
            height: auto;
            padding:3px;
        }
        .list-group-item{
            width: 98%;
            height: auto;
        }
        .m-5{
            margin: 20px;
        }
        .pl-5{
            padding-left: 15px;
        }
        .border{
            border: 1px solid rgb(213, 210, 210);
        }
        .rounded-3{
            border-radius: 5px;
        }
       .divide{
        overflow-x: hidden;
       }
        .divide div{
            display: inline-block;
            height: auto;
            margin: 0px;
        }
       
        .col-9-left{
            width: 75%;
            height: 150px;
            padding: 0px;
            border: 1px solid #eee;
            float: left;

        }
        .col-3-right{
            width: 18%;
            padding: 0px;
            height: 150px;
            border: 1px solid #eee;
            float: right;
        }
        .col-4-left{
            width: 28%;
            padding: 0px;
        }
        .col-8-right{
            width: 66%;
            padding: 0px;
        }
        .text-center{
            text-align: center;
        }
        .text-white{
            color: #ffffff;
        }
        .line-top{
            border-top: 1px solid rgb(213, 210, 210);
        }
        .text-muted{
           opacity: 0.5;
        }
        .fs-3{
            font-size: 16px;
            padding: 2px;
            margin-left: 0;
        }
        .fs-4{
            font-size: 18px;
            padding: 2px;
            margin-left: 0;
        }
        .p-1{
            padding: 1px;
        }
        .m-0{
            margin: 1px;
        }
        .lsp-1{
            letter-spacing: 1px;
        }
        .text-lowercase{
            text-transform: lowercase;
        }
        .text-uppercase{
            text-transform: uppercase;
        }
        .text-capitalize{
            text-transform: capitalize;
        }
        .text-normal{
            text-transform: none;
        }
        .pt-11{
            padding-top: 11px;
        }
        .pb-6{
            padding-bottom: 6px;
        }
        .mt-10{
            margin-top: 10px;
        }
        .mt-20{
            margin-top: 20px;
        }
        .mb-10{
            margin-bottom: 10px;
        }
        .mt-1{
            margin-top: 1px;
        }
        .mt-0{
            margin-top: 0;
        }
        .mr-0{
            margin-right: 0;
        }
        .mr-5{
            margin-right: 5px;
        }
        .headerName{
            text-transform: uppercase;
        }
        .bolder{
            font-weight: bolder;
        }
        .primary{
            color: rgb(44, 44, 228);
        }
        .account-picture .col-9{
            width: 76%;
            height: auto;
            float: left;
        }
        .account-picture .col-3{
            width: 18%;
            height: 145px;
            float: right;
        }
        .passport-col{
            width:98%;
            height: auto;
            border-radius: 5px;
            overflow: hidden;
            padding: 2px;
        }
        .passport{
            width:100%;
            height: 145px;
            border-radius: 5px;
            margin: auto;
            border-radius: 5px;

        }
        @media only screen and (max-width: 850px) {
        .app{
            width:100%;
        }
   
        }
    </style>
</head>
<body>
<div id="app" class="app">
<div class="row mt-10">
    <div class="m-1 headerInfo rounded-3 mr-0">
    <div class="m-5 mt-1 mr-5">
        <div class="m-3">
            <h2 class="fs-4 text-center headerName lsp-1 bolder primary">{{$data['headerName']}}</h2>
        </div>
    </div>
    </div>
</div>
    
    <div class="row mt-10">
    <div class="m-1 border rounded-3 account-picture mr-0">
    <div class="m-5 mt-1 mr-5">
                <div class="col-9">
                    <div class="m-3">
                        <h2 class="fs-4 lsp-1 primary bolder">{{$data['title']}}</h2>
                    </div>
                    <p class="text-normal fs-3 p-1 m-0 text-muted lsp-1">Your personal information such as profile (Name, date of birth, Phone number, email address), contact information and others.</p>
                </div>
                <div class="col-3">
                    <div class="passport-col">
                        <img 
                        class="passport"
                        src="data:image/png;base64,{{ $data['user_image'] }}"
                        alt="No passport"
                        >
                   </div>
                </div>
            </div>
        </div>
    </div>

            <!-- End -->
<div class="row mt-10">
    <div class="m-1 border rounded-3">
    <div class="m-5 mt-1">
        <div class="m-3">
            <h2 class="fs-4 lsp-1 primary">Basic info</h2>
        </div>
        <div class="m-3 mt-1">
            <div class="list-group border rounded-3">
                
        <div class="list-group-item pl-5 pt-11 pb-6">
            <div class="row divide">
                <div class="col-4-left"><p class="text-uppercase fs-3 p-1 m-0 text-muted"><small>ACCOUNT ID</small></p></div>
                <div class="col-8-right"><p class="text-capitalize fs-3 p-1 m-0">{{$data['user_info']['personal_id']}}</p></div>
            </div>
            </div>

        <div class="list-group-item line-top pl-5 pt-11 pb-6">
        <div class="row divide">
            <div class="col-4-left"><p class="text-uppercase fs-3 p-1 m-0 text-muted"><small>SURNAME</small></p></div>
            <div class="col-8-right"><p class="text-capitalize fs-3 p-1 m-0">{{$data['user_info']['lastname']}}</p></div>
        </div>
        </div>
        <div class="list-group-item line-top pl-5 pt-11 pb-6">
            <div class="row divide">
                <div class="col-4-left"><p class="text-uppercase fs-3 p-1 m-0 text-muted"><small>OTHER NAME(s)</small></p></div>
                <div class="col-8-right"><p class="text-capitalize fs-3 p-1 m-0">{{$data['user_info']['firstname']}} {{$data['user_info']['othername']!=""? $data['user_info']['othername'] : ''}}</p></div>
        </div>
        </div>
        <div class="list-group-item line-top pl-5 pt-11 pb-6">
            <div class="row divide">
                <div class="col-4-left"><p class="text-uppercase fs-3 p-1 m-0 text-muted"><small>BIRTHDAY</small></p></div>
                <div class="col-8-right"><p class="text-capitalize fs-3 p-1 m-0">{{$data['user_info']['date_of_birth']!="" ? $data['user_info']['date_of_birth'] : "None"}}</p></div>
        </div>
        </div>
        <div class="list-group-item line-top pl-5 pt-11 pb-6">
            <div class="row divide">
                <div class="col-4-left"><p class="text-uppercase fs-3 p-1 m-0 text-muted"><small>GENDER</small></p></div>
                <div class="col-8-right"><p class="text-capitalize fs-3 p-1 m-0">{{$data['user_info']['gender_name']!="" ? $data['user_info']['gender_name'] : "None"}}</p></div>
        </div>
        </div>

        <div class="list-group-item line-top pl-5 pt-11 pb-6">
            <div class="row divide">
                <div class="col-4-left"><p class="text-uppercase fs-3 p-1 m-0 text-muted"><small>EMAIL ADDRESS</small></p></div>
                <div class="col-8-right"><p class="text-lowercase fs-3 p-1 m-0">{{$data['user_info']['email_one']!="" ? $data['user_info']['email_one'] : "None"}} {{$data['user_info']['email_two']!="" ? '| '. $data['user_info']['email_two'] : ""}}</p></div>
        </div>
        </div>
        <div class="list-group-item line-top pl-5 pt-11 pb-6">
            <div class="row divide">
                <div class="col-4-left"><p class="text-uppercase fs-3 p-1 m-0 text-muted"><small>PHONE NUMBER</small></p></div>
                <div class="col-8-right"><p class="fs-3 p-1 m-0">{{$data['user_info']['phone_one']!="" ? $data['user_info']['phone_code'].$data['user_info']['phone_one'] : "None"}} {{$data['user_info']['phone_two']!="" ? '| '. $data['user_info']['phone_two'] : ""}}</p></div>
        </div>
        </div>

        </div>  
        </div>
    </div>

        </div>
    </div>
    <!-- End -->

    <div class="row mt-10">
            <div class="m-1 border rounded-3">
            <div class="m-5 mt-1">
                <div class="m-3">
                    <h2 class="fs-4 lsp-1 primary">Contact address</h2>
                </div>
                <div class="m-3 mt-1">
                    <div class="list-group border rounded-3">
                <div class="list-group-item pl-5 pt-11 pb-6">
                <div class="row divide">
                    <div class="col-4-left"><p class="text-uppercase fs-3 p-1 m-0 text-muted"><small>State / Country</small></p></div>
                    <div class="col-8-right"><p class="text-capitalize fs-3 p-1 m-0">{{$data['user_info']['state_name']!="" ? $data['user_info']['state_name'] : "None"}} / {{$data['user_info']['country_name']!="" ? $data['user_info']['country_name'] : "None"}}</p></div>
                </div>
                </div>
                <div class="list-group-item line-top pl-5 pt-11 pb-6">
                    <div class="row divide">
                        <div class="col-4-left"><p class="text-uppercase fs-3 p-1 m-0 text-muted"><small>Address</small></p></div>
                        <div class="col-8-right"><p class="text-capitalize fs-3 p-1 m-0">{{$data['user_info']['address_one']!="" ? $data['user_info']['address_one'] : "None"}}</p></div>
                </div>
                </div>
        
                </div>  
                </div>
            </div>
        
                </div>
                </div>
            <!-- End -->

            <div class="row mt-10">
                <div class="m-1">
                        <div class="row">
                    <p class="text-normal text-center fs-3 p-1 m-0 text-muted lsp-1"> Copyright &copy; {{$data['copyright']}}</p>
                    </div>
                    </div>  
                    </div>
                </div>
            
                    </div>
            <!-- End footer -->
<br clear="all"/>
<br clear="all"/>
</div>
</body>
</html>
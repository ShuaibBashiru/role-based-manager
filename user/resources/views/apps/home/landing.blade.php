@extends('layouts.landing')
@section('pageTitle', 'Home')
@section('content')

<div class="container-fluid">
        <!-- <div class="row">
                <div class="col-md-12 p-0 m-0">
                    <menu-header></menu-header>
                </div>
        </div> -->
        
        <div class="row">
        <!-- Body component(s) -->
            <div id="contentPanel" class="col-md-12 p-0 mt-3">
            <div class="mb-5 mt-3">
                
           <banner :server_message="{{ session('message') ?? $message ?? json_encode('') }}"></banner>
      
        </div>
</div>
   </div>

</div>


@endsection('content')
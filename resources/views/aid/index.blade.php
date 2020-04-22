@extends('layouts.aid')
@section('content')  
<div id="aid-app">  
    <navbar-component></navbar-component> 
    <router-view></router-view>
    <div class="row">
        <div class="col-6 text" style="padding-top:8px">
            <a class="btn btn-primary px-2" href="{{ url('login/facebook') }}">
                <i class="fab fa-facebook mr-2"></i> Login with Facebook
            </a>&nbsp;
        </div>
    </div>
</div>


@endsection
@section('styles')
<style>
div.login-button {display:none;}
body.notloggedin .login-button {display:block};
</style> 
@endsection
@section('scripts')
@parent

@endsection
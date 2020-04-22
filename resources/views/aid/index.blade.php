@extends('layouts.aid')
@section('content')  
<div id="aid-app">  
    <navbar-component></navbar-component>
    <router-view></router-view>
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
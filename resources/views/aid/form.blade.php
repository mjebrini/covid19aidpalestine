@extends('layouts.aid')
@section('content') 

@include('aid.partials.menu')
<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col" dir="rtl">
            @if($type==1)
            <h1>طلب مساعدة</h1>
            @else
            <h1>تقديم مساعدة</h1>
            @endif
           
            <hr/>
            <form dir="rtl" class="form-horizontal" action="{{ url('/aid') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="control-label" for="title">{{ trans('aid.title.label') }}</label> 
                    <input name="title" type="text" class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                        <small class="form-text text-danger">{{ trans('aid.title.error') }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="control-label" for="location">{{ trans('aid.location.label') }}*</label> 
                    <input name="location" type="text" class="form-control @error('location') is-invalid @enderror">
                    @error('location')
                        <small class="form-text text-danger">{{ trans('aid.location.error') }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="control-label" for="category">{{ trans('aid.category.label') }}*</label>
                    <select name="category" class="form-control @error('category') is-invalid @enderror">
                        <option value="">اختر نوع المعونة</option>
                        <option value="med">دواء</option>
                        <option value="food">مواد غذائية</option>
                        <option value="consultation">إستشارة</option>
                        <option value="other">أخرى</option>
                    </select>
                    @error('category')
                        <small class="form-text text-danger">{{ trans('aid.category.error') }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="control-label" for="description">{{ trans('aid.description.label') }}*</label> 
                    <textarea name="description" type="text" class="form-control @error('description') is-invalid @enderror"></textarea>
                    @error('description')
                        <small class="form-text text-danger">{{ trans('aid.description.error') }}</small>
                    @enderror
                </div>
                <div class="form-group"> 
                    <input type="hidden" id="_geolocation" name="_geolocation" value="" disabled="disabled" /> 
                    <small id="_geolocation_error" class="form-text text-danger"></small>
                   
                </div>
               
                <input type="hidden" name="type" value="{{ $type }}" />
                <input type="hidden" id="lat_field" name="lat" value="" />
                <input type="hidden" id="lng_field" name="lng" value="" />
                <button type="submit" class="btn btn-primary ">{{ trans('aid.submit.label') }}</button>
            </form>   
        </div>
        <div class="col"></div>
    </div>
</div>
<div id="aid-app">  
    <!-- <navbar-component></navbar-component>  -->
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
<script>
    var x = document.getElementById("_geolocation");
    var latEl = document.getElementById("lat_field");
    var lngEl = document.getElementById("lng_field");
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition( showPosition, showError);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }
    function showPosition(position) {
        x.value = "Latitude: " + position.coords.latitude + " Longitude: " + position.coords.longitude;
        latEl.value = position.coords.latitude;
        lngEl.value = position.coords.longitude;
    }

    var s = document.getElementById("_geolocation_error");
    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
            s.innerHTML = "User denied the request for Geolocation."
            break;
            case error.POSITION_UNAVAILABLE:
            s.innerHTML = "Location information is unavailable."
            break;
            case error.TIMEOUT:
            s.innerHTML = "The request to get user location timed out."
            break;
            case error.UNKNOWN_ERROR:
            s.innerHTML = "An unknown error occurred."
            break;
        }
    }
    getLocation();
</script>
@endsection
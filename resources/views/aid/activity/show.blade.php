@extends('layouts.aid')
@section('content') 

@include('aid.partials.menu')
<div id="aid-app">
    <router-view></router-view>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-xs-12 col-sm-12 col-md-offset-2">
            
              <div class="card"> 
                  <div class="container1"> 
                      <h1><b>{{ $aid->title }}</b></h1>
                      <h5><b>{{ $aid->type == 2 ? 'العرض' : 'المطلوب'}}: {{ $aid->formattedCategory() }}</b></h5>
                      <h5><b>العنوان: {{ $aid->location }}</b></h5>
                      <p>{{ $aid->description }}</p>
                  </div> 
              </div>
            
              <div class="chip">
                  <img src="https://www.w3schools.com/howto/img_avatar.png" alt="{{ $aid->owner->name }}" width="24" height="24">
                  قام {{ $aid->owner->name }} {{ $aid->type == 2 ? 'عرض تقديم مساعدة'  : ' بنشر طلب مساعدة'}} بتاريخ {{ $aid->created_at->format('d/m/Y')  }}
              </div>
            <div style="clear:both;"></div>
            <div class="share-box">
              <div class="fb-share-button" data-href="{{ url('aid/'. $aid->id)}}" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode( url('aid/'. $aid->id) )}}" class="fb-xfbml-parse-ignore">Share</a></div>
            </div>
            <div class="comment-box">
              <div class="fb-comments" data-href="{{ url('aid/'. $aid->id)}}" data-numposts="50" data-width="100%"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('styles')
<meta property="og:url"           content="{{ url('aid/'. $aid->id)}}" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="{{ $aid->type == 2 ? '[معروض]' : '[مطلوب]'}} في {{ $aid->formattedCategory() }} {{ $aid->location }}" />
<meta property="og:description"   content="{{ $aid->description }}" />
<!-- <meta property="og:image"         content="https://www.your-domain.com/path/image.jpg" /> -->
<style>

.card {
  /* Add shadows to create the "card" effect */
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  direction:rtl;
  margin-top:20px;
}

/* On mouse-over, add a deeper shadow */
.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

/* Add some padding inside the card container */
.container1 {
  padding: 2px 16px;
}

.chip {
  float:right;
  display: inline-block;
  text-align:right;
  direction: rtl;
  margin-top:20px;
  padding: 0 25px;
  height: 50px;
  font-size: 16px;
  line-height: 50px;
  border-radius: 25px;
  background-color: #f1f1f1;
}

.chip img {
  float: right;
  margin: 15px 0px 0px 10px; 
  border-radius: 50%;
}

.comment-box {
  margin-top:20px;
}

.share-box {
  float:left;
}

</style> 
@endsection
@section('scripts')
@parent

@endsection
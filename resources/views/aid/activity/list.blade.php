@extends('layouts.aid')
@section('content') 

@include('aid.partials.menu')
<div id="aid-app">  
    <!-- <navbar-component></navbar-component>  -->
    <!-- <router-view></router-view> -->
</div>
<div class="container">
    <div class="row">
        <div class="">
        <div style="direction:rtl;margin-top:20px;">
            :: <a href="?view=map"> عرض الخريطة </a> :: 
            <a href="?view=list">عرض القائمة</a> ::
        </div> 

        @if( $request->input('view','list') == "map" )
        <div class="map-view">
          <div id="aids_map" class="aids_map"></div>
        </div>
        @else
          <div class="grid"> 
              @foreach ($aids as $aid)
              <div class="grid-item">
                  <div class="card">
                      <h3>{{ $aid->type == 2 ? '[معروض]' : '[مطلوب]'}}</h3>
                      <p> {{ $aid->description }} </p>
                      <p>بواسطة {{ $aid->owner->name }} بتاريخ {{ $aid->created_at }}</p>
                      <a href="{{ url('aid/'.$aid->id) }}"><button> أنقر للتفاصيل </button></a>
                  </div>
              </div> 
              @endforeach
          </div>
        @endif
        </div>
    </div>
</div>
@endsection
@section('styles')
<style>

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

.card a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}

.grid {
    direction:rtl;
    text-align:right;
}
.grid-item {
    float:right;
    width:250px;
    padding:10px; 
}

#aids_map { height: 600px; width:100%; }

</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
@endsection
@section('scripts')
@parent
@if( $request->input('view','list') == "list" )
<script src="{{ asset('js/masonry.pkgd.min.js') }}"></script>
<script>
var elem = document.querySelector('.grid');
var msnry = new Masonry( elem, {
  // options
  itemSelector: '.grid-item',
  columnWidth: 250,
  isRTL: true,
  originLeft: false 
});
</script>
@endif

@if( $request->input('view','list') == "map" )
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>

<script>
  var map = L.map('aids_map').setView([31.5263, 35.1024], 15);
  // var aids = JSON.parse("{{ $aids->toJSON() }}");
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  if (navigator.geolocation) {
    navigator.geolocation.watchPosition( showPosition);
  } 

  function showPosition(position) {
    map.setView([position.coords.latitude, position.coords.longitude],13);
    var data = { params : {
      'lat': position.coords.latitude,
      'lng': position.coords.longitude
    }};
    axios.get('api/activities',data)
      .then(function(response){
        var __data = JSON.parse(response.data);
        var _markers = _.filter(__data, function(i) {return i.lat && i.lng });
        _.each(_markers, function(marker){
          var _mapMarker = L.marker([marker.lat, marker.lng],{title:marker.title}).addTo(map);
          _mapMarker.bindPopup('<h3>'+marker.title+'</h3><p>'+marker.location+'</p><p>'+marker.description+'</p><a href="aid/'+marker.id+'">التفاصيل</a>');
        });
      })
      .catch(function(err){
      });
  }
</script>
@endif
@endsection
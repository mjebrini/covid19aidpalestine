@extends('layouts.aid')
@section('content') 
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            <a href="{{ url('/') }}">الرئيسية</a>
            @auth 
                <a href="{{ route('activities') }}">التبرعات</a>
                <a href="{{ route('logout') }}">خروج</a>
            @else
                <a href="{{ url('login/facebook') }}">تسجيل الدخول</a> 
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            مشروع كوفيد إيد فلسطين
        </div>
        <p class="text m-b-md">
            مبادرة مدعومة من مؤسسات المجتمع المدني، والقطاع الخاص وصناديق الزكاة في فلسطين .... إقرا المزيد
        </p>

        @auth
        <div class="links m-b-md">
            <a class="sub-title" href="{{ url('/aid/create?type=2') }}">قدم مساعدة </a>
            <a class="sub-title" href="{{ url('/aid/create?type=1') }}">أطلب مساعدة</a>
        </div>
        @else
        <div class=" m-b-md">
        <a href="{{ url('login/facebook') }}" class="loginBtn loginBtn--facebook">
            دخول بحساب الفيسبوك
        </a>   
        </div>
        @endauth
        

        <div class="links m-b-md"> 
            <a href="{{ url('how-to-use') }}">كيفية الإستخدام</a> 
            <a href="{{ url('terms-of-use') }}">شروط الإستخدام</a> 
            <a href="{{ url('privacy') }}">الخصوصية</a>
        </div>
    </div>
</div>

@endsection
@section('styles')
<!-- Styles -->
<style>
            html, body {
                background-color: #fff;
                color: #636b6f; 
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            .full-height {
                height: 100vh;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref {
                position: relative;
            }
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .content {
                text-align: center;
            }
            .title {
                font-size: 84px;
            } 
            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            } 
            .links > a.sub-title {
                font-size: 34px;
                border: 1px #c1c1c1 solid;
                border-radius: 10px;
                margin-left: 10px;
            }
            .m-b-md {
                margin-bottom: 30px;
            }
            
/* Shared */
.loginBtn {
  box-sizing: border-box;
  position: relative;
  /* width: 13em;  - apply for fixed size */
  margin: 0.2em;
  padding: 5px 15px 5px 46px;
  border: none;
  text-align: left;
  line-height: 34px;
  white-space: nowrap;
  border-radius: 0.2em;
  font-size: 16px;
  color: #FFF;
}
.loginBtn:before {
  content: "";
  box-sizing: border-box;
  position: absolute;
  top: 0;
  left: 0;
  width: 34px;
  height: 100%;
}
.loginBtn:focus {
  outline: none;
}
.loginBtn:active {
  box-shadow: inset 0 0 0 32px rgba(0,0,0,0.1);
}


/* Facebook */
.loginBtn--facebook {
  background-color: #4C69BA;
  background-image: linear-gradient(#4C69BA, #3B55A0);
  /*font-family: "Helvetica neue", Helvetica Neue, Helvetica, Arial, sans-serif;*/
  text-shadow: 0 -1px 0 #354C8C;
}
.loginBtn--facebook:before {
  border-right: #364e92 1px solid;
  background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/14082/icon_facebook.png') 6px 6px no-repeat;
}
.loginBtn--facebook:hover,
.loginBtn--facebook:focus {
  background-color: #5B7BD5;
  color:white;
  background-image: linear-gradient(#5B7BD5, #4864B1);
}
        </style>
@endsection
@section('scripts')
@parent

@endsection
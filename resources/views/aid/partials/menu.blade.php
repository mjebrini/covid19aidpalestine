<div class="topnav" id="myTopnav"> 
        <a href="{{ route('activities') }}">الرئيسية</a>
        <a href="{{ url('/aid/create?type=2') }}">قدم مساعدة </a>
        <a href="{{ url('/aid/create?type=1') }}">أطلب مساعدة</a>
        <a href="{{ route('logout') }}">خروج</a>
        
        <a href="javascript:void(0);" class="icon" v-on:click="toggleMenuView()">
            <svg height="18px" viewBox="0 -53 384 384" width="18px" xmlns="http://www.w3.org/2000/svg"><path d="m368 154.667969h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"/><path d="m368 32h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"/><path d="m368 277.332031h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"/></svg>
        </a>
    </div>
import Vue from 'vue'; 
import VueRouter from 'vue-router';
import * as auth from './facebook';

window.Vue = Vue; 
window.VueRouter = VueRouter;

Vue.use(VueRouter)

import Home from './components/Home.vue';

// routers 
const routes = [
    { path: '/', component:Home},
    { path : '/activities', component :  require('./components/activities.vue')}
];

const router = new VueRouter({ 
    base : 'covid19',
    mode: 'history',
    routes : routes });

// shared compoenents 
Vue.component('navbar-component', require('./components/Navbar.vue') );


// shared config 
Vue.config.ignoredElements = ['fb:login-button'];



window.onAppReady = function() { 

    window.store = {user:null};
    auth.default.login(function(user){
        window.store.user = user; 
        $('body').addClass('loggedin');
    }, function(err){  
        $('body').addClass('notloggedin');
    });

    new Vue({
        router 
    }).$mount('#aid-app');
    
    
}

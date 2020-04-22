let client_auth = {
    getLoggedInUser : function (cb, err) {
        FB.getLoginStatus(function(response) {
            client_auth.statusChangeCallback(response, cb, err);
        });
    },
    statusChangeCallback : function (response, cb, err) { 
        switch (response.status) {
            case 'connected': 
                FB.api('/me', {fields: 'id,name,picture,first_name,last_name,email,short_name'}, function(__user) { 
                    client_auth.user =  __user;
                    cb(__user);
                });
                
                break;
        
            default:   
                err(response.status);    
                break;
        } 
    },
    login : function (cb, err) {
        client_auth.getLoggedInUser(cb, err);
    },
    user : null
};

export default client_auth;

window.fbAsyncInit = function() {
    FB.init({
    appId      : '214888636410038',
    cookie     : true,
    xfbml      : true,
    version    : 'v6.0'
    }); 
    //FB.AppEvents.logPageView(); 
    window.onAppReady? window.onAppReady() : 1;
};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk')); 
<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default"> 
                    <div class="panel-heading"> أهلا بك عزيزي الزائر</div>

                    <div class="panel-body">
                       يتوجب عليك تسجيل الدخول لتمكن من تقديم المساعدة أو طلب المساعدة من الاشخاص الاخرين حولك 

                        <div v-if="!user">
                            <fb:login-button 
                                scope="public_profile,email"
                                onlogin="onAppReady();">
                            </fb:login-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</template>

<script>
    export default {
        computed: {
            isLoggedIn() {
                console.log("isLoggedIn() called", window.store ); 
                return window.store && window.store.user !== null;
            }
        },
        data(){
            return {
                user : window.store.user
            }
        },
        mounted() {
            console.log('Home Component mounted.')
        }
    }
</script>

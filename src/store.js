import Vue from 'vue'
import Vueresource from 'vue-resource'

export const Store = new Vue({ 
    data() {
        return {
            
        }
    },
    methods:{
      pm_login(pm_item) {
        this.$http.post('http://dev.members.panmedia.asia/api/server/login',pm_item).then( response => {
          this.show = false;
          //get member profile
          this.$http.get(
            'http://dev.members.panmedia.asia/api/v1/profile',
            { headers: {
                Authorization: 'Bearer ' + response.body.message.access_token
              }
            }
          ).then( res => {
            
          })
        },function(error) {
          console.log(error)
          this.alert_text = '帳號密碼錯誤';
          this.show = true;
        })
      },
      FB_login() {
        FB.login( response => {
          if( response.status === 'connected' ) {
            this.FB_login_item.access_token = response.authResponse.accessToken;
          }
          this.$http.post('http://dev.members.panmedia.asia/api/server/oauth/facebook',this.FB_login_item).then(
            response => {
              console.log(response);
            }
          )
        }, {scope: 'public_profile,email'})
      }
    }
})
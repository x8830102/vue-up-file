<template>
    <div>
        <div class="bg-secondary p-3">
      <div class="container">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <h5 class="p-4">
              <b>
                <strong>目前投稿人數</strong>
              </b>
              <br> </h5>
          </div>
        </div>
        <div class="row">
          <div class="align-self-center  offset-md-2 col-md-8">
            <div class="card">
              <table class="table">
                <thead>
                  <tr>
                    <th class="text-center">短篇小說</th>
                    <th class="text-center px-0">中短篇小說</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center px-0">200</td>
                    <td class="text-center px-0">300&nbsp;</td>
                  </tr>
                  <tr></tr>
                  <tr></tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="p-0 bg-secondary">
      <div class="container">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <h5 class="text-light p-4">
              <b>
                <strong>作品上傳流程</strong>
              </b>
              <br> </h5>
          </div>
        </div>
      </div>
    </div>
    <div class="bg-secondary p-0">
      <div class="container">
        <div class="row">
          <div class="col-md-4 offset-md-2 text-center">
            <img class="img-fluid d-block rounded-circle mx-auto" src="dist/image/icon_1_active.png" width="100px" height="100px">
            <div class="col-md-12 p-5">
              <p href="#" @click="checked_login"  data-toggle="modal" data-target="#mode_login" class="btn btn-lg m-0 btn-outline-light">STEP 1：個人資料填寫 </p>
            </div>
          </div>
          <div class="col-md-4">
            <img class="img-fluid d-block rounded-circle mx-auto" src="dist/image/icon_2_active.png" width="100px" height="100px">
            <div class="col-md-12 text-center p-5">
              <a href="upload.html" class="btn btn-lg m-0 btn-outline-light">STEP 2：作品上傳 </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="py-5 bg-secondary"></div>
    <!--登入-->
    <div class="modal fade" id="mode_login">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">
              <b>泛科幻獎</b>
            </h3>
            <button type="button" class="close" data-dismiss="modal">
              <span>×</span>
            </button>
          </div>
          <div class="modal-body text-center">
            <transition>
              <div class="alert alert-danger" role="alert" v-if="error_show">
                {{ alert_text }}
              </div>
            </transition>
            <div class="form-check mt-2 form-check-inline form-control-lg">
              <ul>
                <li>
                  <input class="form-check-input" type="radio" id="login" value="on" checked="checked" name="mode">
                  <label class="form-check-label" for="login" @click="redio_toggle('login')">登入</label>
                </li>
                <li>
                  <input class="form-check-input" type="radio" id="reg" value="on" name="mode">
                  <label class="form-check-label" for="reg" @click="redio_toggle('reg')">註冊</label>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <form id="login_form">
                <div class="form-group">
                  <input type="text" v-model:value="pm_login_item.identifier" class="form-control" placeholder="* 帳號 或 E-mail"> </div>
                <div class="form-group">
                  <input type="password" v-model:value="pm_login_item.password" class="form-control" placeholder="* 密碼"> </div>
                <button type="button"  @click="pm_login" class="btn btn-block btn-primary">登入</button>
              </form>
              <form id="reg_form">
                <div class="form-group">
                  <input type="email" v-model:value="register_item.email" class="form-control" placeholder="* E-mail"> </div>
                <div class="form-group">
                  <input type="password" v-model:value="register_item.password" class="form-control" placeholder="* 密碼"> </div>
                <div class="form-group">
                  <input type="password" v-model:value="register_item.password2" class="form-control" placeholder="* 再次輸入密碼"> </div>
                <button type="submit" @click="register" class="btn btn-block btn-primary">註冊</button>
              </form>
              <ul class="list-inline">
                <a href="https://members.panmedia.asia/reset_password" target="_blank">
                  <li class="list-inline-item text-primary text-right">忘記密碼？&nbsp;</li>
                </a>
                <a href="https://members.panmedia.asia/resend_activity_mail" target="_blank">
                  <li class="list-inline-item text-primary">重寄 E-mail 確認信</li>
                </a>
                
              <hr> </ul>
              <p class="text-center">或</p>
              <a class="btn navbar-btn ml-2 text-white btn-secondary btn-block"  @click="FB_login">
                <i class="fa fa-fw fa-facebook mx-3" ></i>Facebook 登入&nbsp; </a>
              <a class="btn navbar-btn ml-2 text-white btn-danger btn-block" ref="google_login" @click="Google_login">
                <i class="fa fa-fw fa-google mx-3"></i>Google 登入&nbsp; </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--end-->
    <div class="px-0">
      <div class="container"> </div>
    </div>
    </div>
    
</template>

<script>
  export default{
    name: 'Content',
    data(){
      return {
        alert_text: '',
        error_show: false,
        pm_login_item: {
          client_id: '5843717039843802',
          identifier: '',
          password: ''
        },
        FB_login_item:{
          provider: 'facebook',
          client_id: '5843717039843802',
          access_token: ''
        },
        Google_login_item:{
          provider: 'google',
          client_id: '5843717039843802',
          access_token: ''
        },
        register_item: {
          client_id: '5843717039843802',
          email: '',
          password: '',
          password2: ''
        }
      } 
    },
    methods:{
      pm_login() {
        this.$http.post('http://dev.members.panmedia.asia/api/server/login',this.pm_login_item).then( access => {
          this.error_show = false;
          //get member profile
          this.$http.get(
            'http://dev.members.panmedia.asia/api/v1/profile',
            { headers: {
                Authorization: 'Bearer ' + access.body.message.access_token
              }
            }
          ).then( res => {
            this.$bus.$emit('login_access',res)
          })
        },error => {
          console.log(error)
          this.alert_text = '帳號密碼錯誤。';
          this.error_show = true;
        })
      },
      FB_login() {
        FB.login( response => {
          if( response.status === 'connected' ) {
            this.FB_login_item.access_token = response.authResponse.accessToken;
          }
          this.$http.post('http://dev.members.panmedia.asia/api/server/oauth/facebook',this.FB_login_item).then( access => {
            this.error_show = false;
            //get member profile
            this.$http.get(
              'http://dev.members.panmedia.asia/api/v1/profile',
              { headers: {
                  Authorization: 'Bearer ' + access.body.message.access_token
                }
              }
            ).then( res => {
              this.$bus.$emit('login_access',res)
            })
          },error => {
            console.log(error)
            this.alert_text = '帳號密碼錯誤。';
            this.error_show = true;
          })
        }, {scope: 'public_profile,email'})
      },
      Google_login() {
        window.gapi.load('auth2', () => {
          const auth2 = window.gapi.auth2.init({
            client_id: '393700711226-fdqbk2nh32772iadtpbp678m5bo92hd0.apps.googleusercontent.com',
            cookiepolicy: 'single_host_origin'
          })
          auth2.attachClickHandler(this.$refs.google_login, {}, googleUser => {
            this.Google_login_item.access_token = googleUser.getAuthResponse().id_token;
            this.$http.post('http://dev.members.panmedia.asia/api/server/oauth/google',this.Google_login_item).then( access => {

            this.error_show = false;
            //get member profile
            this.$http.get(
              'http://dev.members.panmedia.asia/api/v1/profile',
              { headers: {
                  Authorization: 'Bearer ' + access.body.message.access_token
                }
              }
              ).then( res => {
                this.$bus.$emit('login_access',res)
              })
            },error =>{
              console.log(error)
              this.alert_text = '帳號密碼錯誤。';
              this.error_show = true;
            })
          }, error => console.log(error))
        })
      },
      redio_toggle(value) {
        if( value === 'reg' ) {
          $('#login_form').hide();
          $('#reg_form').show();
        } else if ( value === 'login' ) {
          $('#login_form').show();
          $('#reg_form').hide();
        }
      },
      register() {
        if( this.register_item.password != this.register_item.password2 ){
          this.alert_text = '密碼不相同。';
          this.error_show = true;
        }

        this.$http.post('http://dev.members.panmedia.asia/api/server/register',this.register_item).then( access => {
          alert('註冊完成，請前往收信。')
        },error => {
          if( error.body.code == 45 ) {
            this.alert_text = '信箱格式錯誤。';
            this.error_show = true;
          }
        })
      },
      checked_login(){
        if( this.getCookie('username') != null ) {
          window.location = '/panmedia/panscifi-dev/adminlogin';
        } else {
          
        }
      }
    }
  }
</script>
<style>
li { display: inline-block; }

#reg_form{
  display: none;
}

.v-leave {
  opacity: 1;
}

.v-leave-active {
  transition: opacity .5s
}

.v-leave-to {
  opacity: 0;
}

.v-enter {
  opacity: 0;
}

.v-enter-active {
  transition: opacity .5s
}

.v-enter-to {
  opacity: 1;
}

</style>
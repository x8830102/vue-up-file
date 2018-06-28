<template>
    <div>
        <div class="bg-light p-3">
      <div class="container">
        <div class="row">
          <div class="col-md-8 text-color offset-md-2">
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
                    <th class="text-center" style=" cursor: pointer;" @click="load_short_report">短篇小說</th>
                    <th class="text-center px-0" style=" cursor: pointer;" @click="load_novella_report">中短篇小說</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center px-0" style=" cursor: pointer;" @click="load_short_report">
                      {{short_novel_total}}<br>
                      <span>查看投稿紀錄>></span>
                    </td>
                    <td class="text-center px-0" style=" cursor: pointer;" @click="load_novella_report">
                      {{novella_total}}<br>
                      <span>查看投稿紀錄>></span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal" id="short_report">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">
              短篇小說投稿紀錄
            </h3>
            <button type="button" class="close" data-dismiss="modal">
              <span>×</span>
            </button>
          </div>
          <table class="table text-center">
            <thead>
              <th>投稿編號</th>
              <th>上傳時間</th>
            </thead>
            <tbody>
              <tr v-for="( item,index ) in short_novel_data">
                <td>{{ item.novel_no }}</td>
                <td>{{ item.up_date }}</td>
              </tr>
            </tbody>
           
          </table>
          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">取消</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal" id="novella_report">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">
              中短篇小說投稿紀錄
            </h3>
            <button type="button" class="close" data-dismiss="modal">
              <span>×</span>
            </button>
          </div>
          <table class="table text-center">
            <thead>
              <th>投稿編號</th>
              <th>上傳時間</th>
            </thead>
            <tbody>
              <tr v-for="( item,index ) in novella_data">
                <td>{{ item.novel_no }}</td>
                <td>{{ item.up_date }}</td>
              </tr>
            </tbody>
           
          </table>
          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">取消</button>
          </div>
        </div> 

      </div>
    </div>
    <div class="p-0 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <h5 class="text-color p-4">
              <b>
                <strong>作品上傳流程</strong>
              </b>
              <p class="py-3 d-inline-flex text-color">
               <b style="font-size: 16px">&nbsp; (需登入才能投稿)</b>
              </p>
              <br> 
            </h5>
          </div>
        </div>
      </div>
    </div>
    <div class="bg-light p-0">
      <div class="container">
        <div class="row">
          <div class="col-md-4 offset-md-2 text-center">
            <img class="img-fluid d-block rounded-circle mx-auto" src="dist/image/icon_1_active.png" width="100px" height="100px">
            <div class="col-md-12 p-5">
              <p href="#" @click="checked_login($event)" id="myfile_link" data-toggle="modal" class="btn btn-lg m-0 btn-outline-secondary">STEP 1：個人資料填寫 </p>
            </div>
          </div>
          <div class="col-md-4">
            <img class="img-fluid d-block rounded-circle mx-auto" src="dist/image/icon_2_active.png" width="100px" height="100px">
            <div class="col-md-12 text-center p-5">
              <p @click="checked_login($event)" id="upload_link" class="btn btn-lg m-0 btn-outline-secondary">STEP 2：作品上傳 </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="py-5 bg-light"></div>
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
                <li @click="redio_toggle('reg')">
                  <input class="form-check-input" type="radio" id="reg" value="on" name="mode">
                  <label class="form-check-label" for="reg">註冊</label>
                </li>
                <li @click="redio_toggle('login')">
                  <input class="form-check-input" type="radio" id="login" value="on" checked="checked" name="mode">
                  <label class="form-check-label" for="login">登入</label>
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
                  <input type="password" v-model:value="register_item.password" class="form-control" placeholder="* 設定密碼"> </div>
                <div class="form-group">
                  <input type="password" v-model:value="register_item.password2" class="form-control" placeholder="* 再次輸入設定密碼"> </div>
                <button type="button" @click="register" class="btn btn-block btn-primary">註冊</button>
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
        fill_in: false,
        pm_login_item: {
          identifier: '',
          password: ''
        },
        FB_login_item:{
          provider: 'facebook',
          access_token: ''
        },
        Google_login_item:{
          provider: 'google',
          access_token: ''
        },
        register_item: {
          client_id: '9638357746234817',
          email: '',
          password: '',
          password2: ''
        },
        short_novel_data:{},
        novella_data:{},
        short_novel_total:'',
        novella_total:''
      } 
    },
    created() {
      this.$http.post('http://pansf-upload.panmedia.asia/console/novel/all',{novel_type: 1},{emulateJSON: true}).then( success => {
        this.short_novel_data = success.data.data
        this.short_novel_total = success.data.data.length
      })

      this.$http.post('http://pansf-upload.panmedia.asia/console/novel/all',{novel_type: 2},{emulateJSON: true}).then( success => {
        this.novella_data = success.data.data
        this.novella_total = success.data.data.length
      })

      this.$http.post('http://pansf-upload.panmedia.asia/console/member/info',{email: this.getCookie('email')},{emulateJSON: true}).then(success => {
        if ( success.body.success == true ) {
          this.fill_in = true
        }
      })
    },
    mounted() {
      if( location.search.split("=")[1] == 1 ) {
        $('#mode_login').modal()
      }
    },
    methods:{
      pm_login() {
        this.$http.post('http://pansf-upload.panmedia.asia/console/member/signin',this.pm_login_item,{emulateJSON: true}).then( success => {
          if( success.body.success == true ) {
            this.error_show = false;
            this.$bus.$emit('login_access',success)
          } else {
            this.login_error(success.body.msg)
          }
        },error => {
          console.log(error)
          this.login_error(error)
        })
      },
      FB_login() {
        FB.login( response => {
          if( response.status === 'connected' ) {
            this.FB_login_item.access_token = response.authResponse.accessToken;
          }
          this.$http.post('http://pansf-upload.panmedia.asia/console/member/signin',this.FB_login_item,{emulateJSON: true}).then( success => {
            if( success.body.success == true ) {
              this.error_show = false;
              this.$bus.$emit('login_access',success)
            } else {
              this.login_error(success.body.msg)
            }
          },error => {
            this.login_error(error)
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
            this.$http.post('http://pansf-upload.panmedia.asia/console/member/signin',this.Google_login_item,{emulateJSON: true}).then( success => {
              if( success.body.success == true ) {
                this.error_show = false;
                this.$bus.$emit('login_access',success)
              } else {
                this.login_error(success.body.msg)
              }
            },error =>{
              this.login_error(error)
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

        this.$http.post('https://members.panmedia.asia/api/server/register',this.register_item).then( success => {
          alert('請前往收信，驗證完信箱後才算完成註冊。')
          setTimeout("location.reload()", '1000')
        },error => {
          console.log(error)
          if( error.body.code == 45 ) {
            this.alert_text = '信箱格式錯誤。'
            this.error_show = true;
          } else if ( error.body.code == 42 ) {
            this.alert_text = '此信箱已經存在。'
            this.error_show = true
          } else if (error.body.code == 43) {
            this.alert_text = '密碼需為 8~16 英數大小寫混合字元，請重設密碼。'
            this.error_show = true
          }
        })
      },
      checked_login(e){
        if( this.getCookie('username') == null ) {
          $('#mode_login').modal()
        } else {
          if( e.target.id == 'myfile_link' ) {
            window.location = 'myfile';
          } else {
            if( this.fill_in ) {
              window.location = 'upfile';
            } else {
              window.location = 'myfile';
            }
          }
        }
      },login_error(error) {
        console.log(error)
        this.alert_text = '帳號密碼錯誤。';
        this.error_show = true;
      },
      load_short_report(){
        $('#short_report').modal()
      },
      load_novella_report(){
        $('#novella_report').modal()
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

.text-color {
  color: #173f7c;
}
tbody span {
  font-size: 12px;
  color: blue;
}
</style>
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
            <img class="img-fluid d-block rounded-circle mx-auto" src="dist/assets/icon_1_active.png" width="100px" height="100px">
            <div class="col-md-12 p-5">
              <a href="myfile.html" class="btn btn-lg m-0 btn-outline-light">STEP 1：個人資料填寫 </a>
            </div>
          </div>
          <div class="col-md-4">
            <img class="img-fluid d-block rounded-circle mx-auto" src="dist/assets/icon_2_active.png" width="100px" height="100px">
            <div class="col-md-12 text-center p-5">
              <a href="upload.html" class="btn btn-lg m-0 btn-outline-light">STEP 2：作品上傳 </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="py-5 bg-secondary"></div>
    <!--登入-->
    <div class="modal fade" id="mode_loign_reg">
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
              <div class="alert alert-danger" role="alert" v-if="show">
                {{ alert_text }}
              </div>
            </transition>
            <div class="form-check mt-2 form-check-inline form-control-lg" id="login">
              <input class="form-check-input" type="radio" id="exampleCheck1" value="on" checked="checked">
              <label class="form-check-label" for="exampleCheck1">登入</label>
            </div>
            <div class="form-check mt-2 form-control-lg d-inline-flex" id="reg">
              <input class="form-check-input" type="radio" id="exampleCheck1" value="on" name="mode">
              <label class="form-check-label" for="exampleCheck1">註冊</label>
            </div>
            <div class="card-body">
              <form>
                <div class="form-group">
                  <input type="text" v-model:value="pm_login_item.identifier" class="form-control" placeholder="* 帳號 或 E-mail"> </div>
                <div class="form-group">
                  <input type="password" v-model:value="pm_login_item.password" class="form-control" placeholder="* 密碼"> </div>
                <button type="button"  @click="pm_login" class="btn btn-block btn-primary">登入</button>
              </form>
              <ul class="list-inline">
                <li class="list-inline-item text-primary text-right">忘記密碼？&nbsp;</li>
                <li class="list-inline-item text-primary">重寄 E-mail 確認信</li>
                <hr> </ul>
              <p class="text-center">或</p>
              <a class="btn navbar-btn ml-2 text-white btn-secondary btn-block"  @click="FB_login">
                <i class="fa fa-fw fa-facebook mx-3" ></i>Facebook 登入&nbsp; </a>
              <a class="btn navbar-btn ml-2 text-white btn-danger btn-block">
                <i class="fa fa-fw fa-google mx-3"></i>Google 登入&nbsp; </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--end-->
    <!--註冊-->
    <div class="modal fade" id="mode_loign_reg">
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
            <div class="form-check mt-2 form-control-lg d-inline-flex" id="login">
              <input class="form-check-input" type="radio" id="exampleCheck1" value="on" name="mode">
              <label class="form-check-label" for="exampleCheck1">登入</label>
            </div>
            <div class="form-check mt-2 form-check-inline form-control-lg" id="reg">
              <input class="form-check-input" type="radio" id="exampleCheck1" value="on" checked="checked">
              <label class="form-check-label" for="exampleCheck1">註冊</label>
            </div>
            <div class="card-body">
              <form>
                <div class="form-group">
                  <input type="email" class="form-control" placeholder="* E-mail"> </div>
                <div class="form-group">
                  <input type="password" class="form-control" placeholder="* 密碼"> </div>
                <div class="form-group">
                  <input type="password" class="form-control" placeholder="* 再次輸入密碼"> </div>
                <button type="submit" class="btn btn-block btn-primary">註冊</button>
              </form>
              <hr>
              <p class="text-center">或</p>
              <a class="btn navbar-btn ml-2 text-white btn-secondary btn-block">
                <i class="fa fa-fw fa-facebook mx-3"></i>Facebook 登入&nbsp; </a>

              <a class="btn navbar-btn ml-2 text-white btn-danger btn-block btn-sm">
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
        show: false,
        pm_login_item: {
          client_id: '5843717039843802',
          identifier: '',
          password: ''
        },
        FB_login_item:{
          provider: 'facebook',
          client_id: '5843717039843802',
          access_token: ''
        }
      } 
    },
    methods:{
      pm_login() {
        this.$http.post('http://dev.members.panmedia.asia/api/server/login',this.pm_login_item).then( response => {
          this.show = false;
          //get member profile
          this.$http.get(
            'http://dev.members.panmedia.asia/api/v1/profile',
            { headers: {
                Authorization: 'Bearer ' + response.body.message.access_token
              }
            }
          ).then( res => {
            this.$bus.$emit('login_access',res)
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
          this.$http.post('http://dev.members.panmedia.asia/api/server/oauth/facebook',this.FB_login_item).then( response => {
            this.show = false;
            //get member profile
            this.$http.get(
              'http://dev.members.panmedia.asia/api/v1/profile',
              { headers: {
                  Authorization: 'Bearer ' + response.body.message.access_token
                }
              }
            ).then( res => {
              this.$bus.$emit('login_access',res)
            })
          },function(error) {
            console.log(error)
            this.alert_text = '帳號密碼錯誤';
            this.show = true;
          })
        }, {scope: 'public_profile,email'})
      }
    }
  }
</script>
<style>
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
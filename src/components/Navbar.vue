<template>
  <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light">
    <div class="container">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse text-center justify-content-center" id="navbar2SupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="http://pansf.panmedia.asia/">首頁</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://pansf.panmedia.asia/2">徵文啟事</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://pansf.panmedia.asia/3">投稿注意事項</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://pansf.panmedia.asia/4">徵文與活動報名</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="/">作品上傳</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://pansf.panmedia.asia/5">合作夥伴</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://pansf.panmedia.asia/6">聯繫總部</a>
          </li>
        </ul>
        <a class="btn navbar-btn ml-2 text-white btn-primary login-btn" data-toggle="modal" data-target="#mode_login">註冊 / 登入&nbsp;
          <i class="fa d-inline fa-lg fa-user-circle-o"></i>
        </a>
          <div class="btn-group" style="display: none;">
            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> {{ nickname }}&nbsp;
              <i class="fa d-inline fa-lg fa-user-circle-o"></i>
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="myfile">個人資料</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#" @click="logout">登出</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
  export default {
    name: 'Navbar',
    data(){
      return {
        nickname: ''
      }
    },
    created() {
      this.$bus.$on('login_access', (msg) => {
        console.log(msg);
        let expireDays = 1000 * 60 * 60 * 24 * 15;
        this.setCookie('username', msg.body.user.nickname, expireDays);
        this.setCookie('email', msg.body.user.email, expireDays);
        location.reload() 
      });
    },
    mounted() {
      if( this.getCookie('username') != null ) {
        $('.btn-group').show()
        $('.login-btn').hide()
        this.nickname = unescape(this.getCookie('username'))
      }
    },
    methods:{
      logout() {
        this.delCookie('username')
        window.location = '/';
      }
    }
  }
</script>
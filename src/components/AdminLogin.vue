<template>
    <div class="container">
        <Header></Header>
        <div class="row justify-content-center">
            <div class="col-lg-6 shadow-lg bg-cyan rounded form p-4">
                <form @submit.prevent="submit">
                    <transition>
                      <div class="alert alert-danger" role="alert" v-if="error_show">
                        {{ alert_text }}
                      </div>
                    </transition>
                    <h2 class="text-left">泛科幻獎管理後台</h2>
                    <div class="form-group">
                        <label for="EmailAdderss">Email adderss</label>
                        <input type="email" name="email" class="form-control" id="EmailAdderss" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="Password">password</label>
                        <input type="password"  class="form-control" id="Password" aria-describedby="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                
            </div>
        </div>
    </div>
</template>

<script>
import Header from './Header.vue'

export default {
  name: 'Adminlogin',
  components: {
    Header
  },
  data () {
    return {
        error_show: false,
        alert_text: '',
    }
  },
  created() {
    this.$bus.$on('admin_login', (msg) => {
        let expireDays = 1000 * 60 * 60 * 24 * 15
        this.setCookie('success', msg.data.success, expireDays)
    })
  },
  methods: {
    submit(e){
        const formdata = new FormData(e.target)
        this.$http.post('http://pansf-upload.panmedia.asia/console/admin/login_admin',formdata,{emulateJSON: true}).then(success => {
            if( success.data.success ){
                this.$bus.$emit('admin_login', success)
                window.location = 'admin';
            } else {
                this.error_show = true
                this.alert_text = '無此帳號'
            }
            
        })
    }
  }
}
</script>
<style>
.form {
    background: gainsboro;
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
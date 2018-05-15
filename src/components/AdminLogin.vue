<template>
    <div class="container">
        <Header></Header>
        <div class="row justify-content-center">
            <div class="col-lg-6 shadow-lg bg-cyan rounded form p-4">
                <form action="">
                    <h2 class="text-left">泛科幻獎管理後台</h2>
                    <div class="form-group">
                        <label for="EmailAdderss">Email adderss</label>
                        <input type="email" class="form-control" id="EmailAdderss" aria-describedby="emailHelp" placeholder="Enter email">
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
    }
  }
}
</script>
<style>
    .form {
        background: gainsboro;
    }
</style>
<template>

  <div id='app'>
    <home></home>
  </div>
</template>

<script>

import Home from './components/Home.vue'
export default {
  name: 'app',
  components:{
    Home
  },
  data () {
    return {
      msg: 'Welcome to Your Vue.js App'
    }
  }
}
</script>

<style lang="css">
@import '~bootstrap/dist/css/bootstrap.css';
@import './theme.css';
</style>

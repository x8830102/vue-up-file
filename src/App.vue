<template>

  <div id='app'>
    <router-view/>
  </div>
</template>

<script>

export default {
  name: 'app',
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

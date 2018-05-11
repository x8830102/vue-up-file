import Vue from 'vue'
import App from './App.vue'
import Vueresource from 'vue-resource'

import "jquery"
import "bootstrap"

Vue.use(Vueresource)
//global event bus
const EventBus = new Vue()
Object.defineProperties(Vue.prototype, {
    $bus: {
        get: function () {
            return EventBus
        }
    }
})

new Vue({
  el: '#app',
  render: h => h(App)
})

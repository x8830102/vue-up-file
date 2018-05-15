import Vue from 'vue'
import router from 'vue-router'

import Home from './components/Home.vue'
import AdminLogin from './components/AdminLogin.vue'
import Admin from './components/Admin.vue'

Vue.use(router);
export default new router({
    mode:'history',
    routes:[
        {
            path: '/',
            name: 'Home',
            component: Home
        },
        {
            path: '/adminlogin',
            name: 'adminlogin',
            component: AdminLogin,
        },
        {
            path:'/admin',
            name: 'admin',
            component: Admin
        }
    ]

})
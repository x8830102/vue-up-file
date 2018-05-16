import Vue from 'vue'
import router from 'vue-router'

import Home from './components/Home.vue'
import AdminLogin from './components/AdminLogin.vue'
import Admin from './components/Admin.vue'
import Upload from './components/Upload.vue'
import Myfile from './components/Myfile.vue'

Vue.use(router);
export default new router({
    mode: 'history',
    base: '/panmedia/panscifi-dev',
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
            path: '/admin',
            name: 'admin',
            component: Admin
        },
        {
            path: '/upfile',
            name: 'upload',
            component: Upload
        },
        {
            path: '/myfile',
            name: 'myfile',
            component: Myfile
        }
    ]

})
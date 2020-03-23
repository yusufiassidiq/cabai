import './bootstrap'

import Index from './Index'
import auth from './auth'
import router from './router'

// import dependecies tambahan
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import Vue from 'vue';
import 'es6-promise/auto'
import VueAuth from '@websanova/vue-auth'

// Set Vue globally
window.Vue = require('vue');

// import vform library 
// Doc = https://github.com/cretueusebiu/vform
import { Form, HasError, AlertError } from 'vform'
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
window.Form = Form;

// Set Vue router
Vue.router = router
Vue.use(VueRouter)

// Set Vue authentication
Vue.use(VueAxios, axios)
axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`
console.log(process.env.MIX_APP_URL)
Vue.use(VueAuth, auth)

// Load Index
Vue.component('index', Index)

const app = new Vue({
    el: '#app',
    router,
  });
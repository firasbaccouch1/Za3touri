/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');



window.Vue = require('vue').default;
// vuex
import store from './Store/Store';
import Vue from 'vue';
//end vuex

import VueCookies from 'vue-cookies';
Vue.use(VueCookies);
import VueLazyload from 'vue-lazyload'
Vue.use(VueLazyload, {
  preLoad: 1.3,
  attempt: 1,
})
import Toasted from 'vue-toasted';
Vue.use(Toasted, {
  duration: 2500,
  position: 'top-right',
  theme: 'bubble',
  iconPack: 'fontawesome',
  icon : 'check',
  type:'success'

})

// end lazyload img
import moment from 'moment';
Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(value).fromNow()
    }
});



//router imported 
import router from '../../routes'


// header component
 Vue.component('HeaderVue', require('../../components/frontend/Layout/HeaderVue.vue').default);
// end header component

const app = new Vue({
    el: '#vue',
    store,
    router,
    VueCookies,


});



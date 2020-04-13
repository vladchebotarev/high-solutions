import Vue from 'vue'
import VueRouter from 'vue-router'
import Notifications from 'vue-notification'

Vue.use(VueRouter)
Vue.use(Notifications)
Vue.component('pagination', require('laravel-vue-pagination'));

import App from './views/App'
import Welcome from './views/Welcome'
import Character from './views/Character'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Welcome
        },
        {
            path: '/character/:id',
            name: 'character',
            component: Character,
            props: true
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: {App},
    router,
});


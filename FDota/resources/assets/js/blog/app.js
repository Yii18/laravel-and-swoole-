window.Vue = require('vue');
require('vue-resource');

import VueLazyload from 'vue-lazyload'; // 图片懒加载
import VueRouter from 'vue-router';
import routes from './routes';
import store from './store/index';
import App from './components/app.vue';
import loadingComponent from './components/include/loading.vue' // 全局loading组件

Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', document.getElementsByName('csrf-token')[0].content);
    next();
});

Vue.http.options.emulateJSON = true;

Vue.use(VueLazyload, {
    preLoad: 1.3,
    error: '/images/404.png',
    loading: '/images/loading-spin.svg',
    attempt: 1
});

Vue.use(VueRouter);

Vue.component('loading', loadingComponent);

const router = new VueRouter({
    mode: 'history',
    base:'/',
    linkActiveClass: 'active',
    routes: routes,
    scrollBehavior (to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        } else {
            return false;
        }
    }
});

store.dispatch('checkLogin')

new Vue(Vue.util.extend({ router, store }, App)).$mount('#dota-app');
require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)
let routes = [
    { path: '/', component: require('./components/Dashboard.vue').default },
  
  ]

  const router = new VueRouter({
    mode: 'history',
    routes 
  })

  
Vue.component(
    'Post',
    require('./components/Post.vue').default
  );
  Vue.component(
    'PopularPosts',
    require('./components/PopularPosts.vue').default
  );

const app=new Vue({
    el:'#app',
    router,
});

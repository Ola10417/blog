require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)
let routes = [
    { name:'dashboard', path: '/', component: require('./components/Dashboard.vue').default },
    { name:'viewPost', path: '/posts/:id', component: require('./components/viewPost.vue').default, props: true },
  ]

  const router = new VueRouter({
    mode: 'hash',
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
  Vue.component(
    'viewPost',
    require('./components/viewPost.vue').default
  );

  
  Vue.filter('cutbody',function (val) {
    return val.slice(0,300)+val[300].replace(/\W+/g, '')+"...";
})

const app=new Vue({
    el:'#app',
    router,
});

require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import Cookies from 'js-cookie'
import { v4 as uuidv4 } from 'uuid'
import Swal from 'sweetalert2'
import { Form, HasError, AlertError } from 'vform'

Vue.use(VueRouter)
let routes = [
    { name:'dashboard', path: '/', component: require('./components/Posts/Dashboard.vue').default },
    { name:'viewPost', path: '/posts/:id', component: require('./components/Posts/viewPost.vue').default, props: true },
    { name:'aboutMe', path: '/about-me', component: require('./components/aboutMe.vue').default},
  ]

  const router = new VueRouter({
    mode: 'hash',
    routes 
  })


window.Swal=Swal;
window.Cookies=Cookies;
window.uuidv4=uuidv4;
window.Form=Form;

Vue.component(
    'Post',
    require('./components/Posts/Post.vue').default
  );
  Vue.component(
    'PopularPosts',
    require('./components/Posts/PopularPosts.vue').default
  );
  Vue.component(
    'viewPost',
    require('./components/Posts/viewPost.vue').default
  );
  Vue.component(
    'Comment',
    require('./components/Posts/Comment.vue').default
  );

  
  Vue.filter('cutbody',function (val) {
    return val.slice(0,300)+val[300].replace(/\W+/g, '')+"...";
})

const app=new Vue({
    el:'#app',
    router,
});

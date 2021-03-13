require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import Cookies from 'js-cookie'
import { v4 as uuidv4 } from 'uuid'
import Swal from 'sweetalert2'
import { Form, HasError, AlertError } from 'vform'
import CKEditor from '@ckeditor/ckeditor5-vue2';
Vue.use(VueRouter)
Vue.use( CKEditor );
let routes = [
    { name:'dashboard', path: '/', component: require('./components/Posts/Dashboard.vue').default },
    { name:'viewPost', path: '/posts/:id', component: require('./components/Posts/viewPost.vue').default, props: true },
    { name:'aboutMe', path: '/about-me', component: require('./components/aboutMe.vue').default},
    { name:'manage', path: '/manage', component: require('./components/Management/ManageDashboard.vue').default},
    { name:'newPost', path: '/newPost', component: require('./components/Management/newPost.vue').default},
    { name:'editPost', path: '/editPost/:id', component: require('./components/Management/editPost.vue').default},
    { name:'users', path: '/users', component: require('./components/Management/users.vue').default}
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
  
  Vue.component('pagination', require('laravel-vue-pagination'));
  
  Vue.filter('cutbody',function (val) {
    if(val.length>300)
    { 
      return val.slice(0,300)+val[300].replace(/\W+/g, '')+"...";
    }
    return val
})

Vue.filter('getDate',function (val) {
  if(val){
  return val.substring(0,10)+" "+val.substring(11,19)
  }
})


const app=new Vue({
    el:'#app',
    router,
});


<template>
    <div>
        <h3><router-link :to="{ name: 'viewPost', params: { id: post.id } }">{{post.title}}</router-link></h3>
        <div v-if="authUser">
            <form>
            <button type="submit" @click.prevent="delPost(post.id)">Usuń</button>
            </form>
        </div>
        <h5>{{post.created_at}}</h5>
        <div>
            {{post.body | cutbody}} 
            <router-link :to="{ name: 'viewPost', params: { id: post.id } }"><button>Czytaj dalej</button></router-link>
        </div>
    </div>
</template>
<script>
export default {
    props: [
        'post'
    ],
    data() {
              return {
                   authUser: window.authUser
              }
          },
    methods:{
        delPost(id){
            this.$emit('delPost', id);
        }
    }
    
}
</script>
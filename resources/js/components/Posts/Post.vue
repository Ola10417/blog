<template>
    <div class="mt-4">
        <h3><router-link :to="{ name: 'viewPost', params: { id: post.id } }">{{post.title}}</router-link></h3>
        
        <h5>{{post.created_at | getDate}}</h5>

        <div v-if="authUser" class="row">
            <div class="col-1">
                <a v-bind:href="'/#/editpost/'+post.id"><button class="btn btn-outline-warning">Edytuj</button></a>
            </div>
            <div class="col-1">
                <form>
                <button type="submit" @click.prevent="delPost(post.id)" class="btn btn-outline-danger">Usuń</button>
                </form>
            </div>
            
            
        </div>
        <div >
            <div v-html="$options.filters.cutbody(post.body)" ></div>
            <router-link :to="{ name: 'viewPost', params: { id: post.id } }" class=""><button class=" btn btn-outline-secondary">Czytaj dalej</button></router-link>
        
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
        },
    }
    
}
</script>
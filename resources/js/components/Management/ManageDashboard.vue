<template>
    <div v-if="authUser" class="container mt-2">
        <h3>Zarządzanie stroną</h3>

        <div>
            <span v-if="this.authUser.role=='admin' || this.authUser.role=='editor'">
                <a href="/#/newpost"><button class="btn btn-outline-success">Dodaj wpis</button></a>
            </span>
            <span v-if="this.authUser.role=='admin'">
                <a href="/register"><button class="btn btn-outline-success">Dodaj użytkownika</button></a>
            <a href="/#/users"><button class="btn btn-outline-secondary">Pokaz uzytkownikow</button></a>
            </span>
            
        </div>
        <div class="mt-4">
            <h3>Najnowsze komentarze</h3>
             <div v-if="comments.length>0">
                <div v-for="comment in comments" v-bind:key="comment.id" class="mt-2">
                    <div style="font-size:22px;">{{comment.userName}}</div>
                    <div style="font-size:12px;">{{comment.created_at | getDate}}</div>
                    <div style="font-size:18px;">{{comment.comment}}</div>
                    <a :href="'/#/posts/'+comment.post_id" class=""><button class="btn btn-outline-primary mt-1 btn-sm">Zobacz wpis</button></a>
                    
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
              return {
                   authUser: window.authUser,
                   comments:[]
              }
          },
    methods:{
      getComments(){
            axios.get('api/latestcomments').then(response => {
                        this.comments = response.data;
                        });
            
      }  
    },
    mounted(){
        this.getComments();
    }

          
}
</script>
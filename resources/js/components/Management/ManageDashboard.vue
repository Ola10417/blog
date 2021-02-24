<template>
    <div v-if="authUser">
        <h3>Zarządzanie stroną</h3>
        <div v-if="this.authUser.role=='admin' || this.authUser.role=='editor'">
            <a href="/#/newpost"><button>Dodaj wpis</button></a>
        </div>
        <div>
            Najnowsze komentarze
            <div v-for="comment in comments" :key="comment.id">
                <h4>{{comment.userName}}</h4>
                <h5>{{comment.comment}}</h5>
                <h5>{{comment.created_at}}</h5>
                <a :href="'/#/posts/'+comment.post_id"><button>Zobacz wpis</button></a>
            </div>
        </div>
        <div v-if="this.authUser.role=='admin'">
            <a href="/register"><button>Dodaj użytkownika</button></a>
            <a href="/#/users"><button>Pokaz uzytkownikow</button></a>
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
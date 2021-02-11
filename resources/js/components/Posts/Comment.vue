<template>
    <div>
        <div>
            <form>
            <label>Nazwa użytkownika</label>
            <input v-model="form.userName" name="userName"><br>
            <label>Komentarz</label>
            <textarea v-model="form.comment" name="comment"></textarea>
            <button type="submit" @click.prevent="AddComm">Ok</button>
            </form>
        </div>
        <div v-if="comments.length>0">
            <div v-for="comment in comments" v-bind:key="comment.id">
                <h4>{{comment.userName}}</h4>
                <h5>{{comment.comment}}</h5>
                <h5>{{comment.created_at}}</h5>
            </div>
        </div>
        <div v-else>
            Nie ma jeszcze żadnych komentarzy...
        </div>
        
    </div>
</template>
<script>
export default {
    data(){
        return{
            comments:[],
            form: new Form({
            user:'',
            userName: '',
            comment: '',
            post_id:''
            

            })
        }
    },
    methods:{
        getComments(){
            axios.get('api/comments/'+this.$route.params.id).then(response => {
              this.comments = response.data;
            });
        },
        AddComm(){
          this.form.user=Cookies.get('uuid')
          this.form.post_id=this.$route.params.id
          this.form.post('api/comments')
          .then(()=>{
              this.getComments()
              this.form.reset()
            })
        
            
            
        },
        
    },
    created(){
        this.getComments()
    }
}
</script>
<template>
    <div>
        <div>
            <form class="">
            
            <input v-model="form.userName" name="userName" placeholder="Nazwa użytkownika" class="form-control w-25">
            <textarea v-model="form.comment" name="comment" placeholder="Komentarz" class="mt-2 form-control w-50"></textarea>
            <button type="submit" @click.prevent="AddComm" class="mt-2 btn btn-outline-success">Opublikuj komentarz</button>
            </form>
        </div>
        
        <div v-if="comments.length>0">
            <div v-for="comment in comments" v-bind:key="comment.id" class="mt-2">
                <div style="font-size:22px;">{{comment.userName}}</div>
                <div style="font-size:12px;">{{comment.created_at | getDate}}</div>
                <div style="font-size:18px;">{{comment.comment}}</div>
                
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
<template>
<div>
    <div>
        <h3>{{post.title}}</h3>
        <h5>{{post.created_at}}</h5>
        <div>
            {{post.body }}
        </div>
        
    </div>
    <div>
            <h5>Oceń ten artykuł!</h5>
            <div :id="post.id" >
            <button @click="ratePost(2)"><i class="fas fa-heart" style="font-size:32px;" ></i></button>
            <button @click="ratePost(1)"><i class="far fa-thumbs-up" style="font-size:32px;"></i></button>
            <button @click="ratePost(-1)"><i class="far fa-thumbs-down" style="font-size:32px;"></i></button>
            </div>
    </div>
    <div>
        napisz komentarz
        <AddComment />
        
        Komentarze <br>
        <Comment />
    </div>
</div>
</template>
<script>
import Comment from './Comment.vue';
export default {
  components: { Comment },
    
    data(){
        return{
            post:{},
            rating:[]
        }
    },
    methods:{
        getPost(){
            axios.get('api/posts/'+this.$route.params.id).then(response => {
              this.post = response.data;
            });
            
            
        },

        getRating(){
            axios.get('api/rating')
            .then(response => {
            this.rating = response.data;
            });
        },

        checkIfUserHasAlreadyRated()
        {
            for(var i=0; i <this.rating.length; i++)
            {
                console.log('dzialaj')
                for(var rat in this.rating)
                {
                    if(this.rating[rat].user==Cookies.get('uuid') && this.rating[rat].post_id==this.$route.params.id){
                        return true
                    }
                }
                return false
            }
            
        },
        ratePost(points){
            
            if(this.rating.length>0)
            {
                if(Cookies.get('uuid'))
                {
                    
                    if(this.checkIfUserHasAlreadyRated()){
                        Swal.fire({
                        icon: 'error',
                        title: 'Ups...',
                        text: 'Już zagłosowałeś!'
                        })
                    }
                    else
                    {

                        axios.post('api/rating',{
                            user: Cookies.get('uuid'),
                            post_id: this.$route.params.id,
                            points: points
                        }).then(function (response) {
                            Swal.fire({
                            icon: 'success',
                            title: 'Dziękujemy za ocenę!',
                            showConfirmButton: false,
                            timer: 1500
                            })
                        })
                        .catch(function (error) {
                            console.log('blad');            
                        });;
                        
                    this.getRating();
                    }
                    
                }
            }
          
        },
        
    },
    created(){
        this.getPost()
        this.getRating()
    }
}
</script>
<style>
i:hover{
    cursor: pointer;
}

.fa-heart:hover{
    color: rgb(211, 22, 22);
}
.far:hover{
    color:blue;
}

</style>
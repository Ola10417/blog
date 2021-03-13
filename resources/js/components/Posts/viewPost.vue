<template>
<div class="mt-3 container">
    <button class="btn btn-outline-secondary">Wstecz</button>
    <div class="mt-2">
        <h3>{{post.title}}</h3>
        <h5>{{post.created_at | getDate}}</h5>
        <div class="pb-3" style="border-bottom:2px solid #eeeeee;" v-html="post.body">
            
        </div>
        
    </div>

    <div class=" mt-3">
        <div class="row">
            <div class="col-10">
                <h5>Napisz komentarz!</h5>
                <Comment />
            </div>

            <div :id="post.id" class="rate col " >
            <button v-if="!ratedHeart" @click="ratePost(2)"><i class="fas fa-heart" style="font-size:32px;" ></i></button>
            <button v-if="ratedHeart" @click="showAlertThatUserHasAlreadyVoted()"><i class="fas fa-heart" style="font-size:32px; color:red;" ></i></button>
            <button v-if="!ratedUpvote" @click="ratePost(1)"><i class="far fa-thumbs-up" style="font-size:32px;"></i></button>
            <button v-if="ratedUpvote" @click="showAlertThatUserHasAlreadyVoted()"><i class="far fa-thumbs-up" style="font-size:32px; color:blue;"></i></button>
            <button v-if="!ratedDownvote" @click="ratePost(-1)"><i class="far fa-thumbs-down" style="font-size:32px;"></i></button>
            <button v-if="ratedDownvote" @click="showAlertThatUserHasAlreadyVoted()"><i class="far fa-thumbs-down" style="font-size:32px; color:blue;"></i></button>

            </div>
        </div>
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
            rating:[],
            ratedHeart:false,
            ratedUpvote:false,
            ratedDownvote:false,
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
            this.checkIfUserHasAlreadyRated()
            });
            
        },

        showAlertThatUserHasAlreadyVoted(){
            Swal.fire({
                        icon: 'error',
                        title: 'Ups...',
                        text: 'Już zagłosowałeś!'
                        })  
        },

        checkIfUserHasAlreadyRated()
        {
            for(var i=0; i <this.rating.length; i++)
            {
                for(var rat in this.rating)
                {
                    if(this.rating[rat].user==Cookies.get('uuid') && this.rating[rat].post_id==this.$route.params.id){
                        switch(this.rating[rat].points){
                            case 2: this.ratedHeart=true; break;
                            case 1: this.ratedUpvote=true; break;
                            case -1: this.ratedDownvote=true; break;
                        }
                        return true   
                    }
                }
                return false
            }
        },

        ratePost(points){
            
            
                if(Cookies.get('uuid'))
                {
                    if(this.checkIfUserHasAlreadyRated()){
                        this.showAlertThatUserHasAlreadyVoted()
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
                        });
                        
                    this.getRating();
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
.rate button{
    background-color: white;
    border: none;
}

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
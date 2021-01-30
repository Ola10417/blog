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
            <i class="fas fa-heart" style="font-size:32px;" @click="ratePost(2)"></i>
            <i class="far fa-thumbs-up" style="font-size:32px;" @click="ratePost(1)"></i>
            <i class="far fa-thumbs-down" style="font-size:32px;" @click="ratePost(-1)"></i>
    </div>
</div>
</template>
<script>
export default {
    
    data(){
        return{
            post:{}
        }
    },
    methods:{
        getPost(){
            axios.get('api/posts/'+this.$route.params.id).then(response => {
              this.post = response.data;
            });
            
            
        },

        ratePost(points){
            this.post.popularity+=points
            
            console.log(this.post.popularity)
            axios.put('api/posts/' + this.$route.params.id, { 
                popularity: this.post.popularity   
            })
            .then(function (response) {
                console.log('ok');
            })
            .catch(function (error) {
                console.log('blad');            
            });
        },
    },
    created(){
        this.getPost()
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
<template>
<div>
    <div>
        <h3>{{post.title}}</h3>
        <h5>{{post.created_at}}</h5>
        <div>
            {{post.body }}
        </div>
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
            console.log(this.$route.params.id)
            axios.get('api/posts/'+this.$route.params.id).then(response => {
              this.post = response.data;
            });
            
        }
    },
    created(){
        this.getPost()
    }
}
</script>
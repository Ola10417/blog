<template>
    <div>
        <div>
            <Post :post="post" v-for="post in posts" :key="post.id" />
        </div>
        <div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            posts:{}
        }
    },
    methods:{
        getResults(){
            axios.get('api/posts')
            .then(response => {
              this.posts = response.data;
            });
            console.log(this.posts)
        }
    },
    created(){
        this.getResults()
    }
}
</script>
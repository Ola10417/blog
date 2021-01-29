<template>
    <div>
        <div>
            <Post :post="post" v-for="post in posts" :key="post.id" />
        </div>
        <div>
            <div>
                <h3>Popularne wpisy</h3>
                <PopularPosts :popularPost="popularPost" v-for="popularPost in popularPosts" :key="popularPost.id" />
            </div>
            <div>
                <h3>Szukaj postów</h3>
                <input type="text" placeholder="Tytuł posta">
                <button>Szukaj</button>
            </div>
            <div></div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            posts:{},
            popularPosts:{}
        }
    },
    methods:{
        getResults(){
            axios.get('api/posts')
            .then(response => {
              this.posts = response.data;
            });

            axios.get('api/popularPosts')
            .then(response => {
              this.popularPosts = response.data;
            });

        }
    },
    created(){
        this.getResults()
    }
}
</script>
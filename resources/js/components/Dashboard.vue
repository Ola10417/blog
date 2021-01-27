<template>
    <div>
        <div>
            <div v-for="post in posts" :key="post">

                <h3>{{post.title}}</h3>
                <h5>{{post.created_at}}</h5>
                <div>
                    {{post.body}}
                </div>
            </div>
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
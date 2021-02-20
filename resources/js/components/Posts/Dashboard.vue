<template>
    <div>
        <div>
                <h3>Szukaj postów</h3>
                <input type="text" placeholder="Tytuł posta" v-model="searchQuery">
                <button >Szukaj</button>
            </div>
        <div>
            <div v-if="!search"><Post :post="post" v-for="post in posts" :key="post.id" @delPost="deletePost" /></div>
            <div v-if="search"><Post :post="post" v-for="post in filteredResources" :key="post.id" @delPost="deletePost" /></div>
        </div>
        <div>
            <div>
                <h3>Popularne wpisy</h3>
                <PopularPosts :popularPost="popularPost" v-for="popularPost in popularPosts" :key="popularPost.id" />
            </div>
            <div></div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            search:false,
            searchQuery: null,
            posts:[],
            popularPosts:[],
            filteredResources: []
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

            
            
        },

        deletePost(id){
            axios.post('/posts/destroy/'+id,{_method: 'delete'}).then(()=>{
              console.log('sukces')
              Swal.fire({
                            icon: 'success',
                            title: 'Wpis został usnięty!',
                            showConfirmButton: false,
                            timer: 1500
                            })
            this.getResults()

            })
            .catch(function (error) {
              Swal.fire({
                        icon: 'error',
                        title: 'Ups...',
                        text: 'Nie udało się usunąć posta!'
                        })             
            });
        },

        createUserCookie(){
            if(!Cookies.get('uuid'))
            {
            Cookies.set('uuid',uuidv4(), { expires: 10000, secure: true, sameSite: 'strict' })
            
            }
            console.log(Cookies.get('uuid'))
        }

    },
    
    watch: {
        searchQuery() {
        this.search=true
        this.filteredResources = this.posts.filter(post =>
            post.title.match(this.searchQuery)
        );
        console.log(this.filteredResources);
        }
    },
    
    mounted(){
        this.getResults()
        this.createUserCookie()
    }
}
</script>
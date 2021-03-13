<template>
    <div class="container mt-3">
        <div class="row gx-5">
            <div class="col-9">
            <div class="">
                <h3>Szukaj postów</h3>
                <input type="text" placeholder="Tytuł posta" v-model="searchQuery" class="form-control">
                
            </div>
            <div class="mt-3">
                <div v-if="!search"><Post :post="post" v-for="post in posts.data" :key="post.id" @delPost="deletePost" />
                <pagination :data="posts" @pagination-change-page="getResults" class="mt-3"></pagination>
                </div>
                
                <div v-if="search"><Post :post="post" v-for="post in filteredResources" :key="post.id" @delPost="deletePost" /></div>
                
                
            </div>
            </div>
            <div class="col-2">
                <div>
                    <h3 class="pb-2" style="border-bottom:2px solid #eeeeee;">Popularne wpisy</h3>
                    <PopularPosts :popularPost="popularPost" v-for="popularPost in popularPosts" :key="popularPost.id" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            search:false,
            searchQuery: null,
            posts:{},
            allPosts:{},
            popularPosts:{},
            filteredResources: []
        }
    },
    methods:{
        getResults(page=1){
            axios.get('api/posts?page=' + page)
            .then(response => {
              this.posts = response.data;
            });

            
        },


        getPosts(){

            axios.get('api/posts/all')
            .then(response => {
              this.allPosts = response.data;
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
        
        this.filteredResources = this.allPosts.filter(post =>
            post.title.match(this.searchQuery)
        );
        if(this.searchQuery=="") this.search=false
        console.log(1);
        }
    },
    
    mounted(){
        this.getResults()
        this.createUserCookie()
        this.getPosts()
    }
}
</script>
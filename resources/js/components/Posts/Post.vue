<template>
    <div>
        <h3><router-link :to="{ name: 'viewPost', params: { id: post.id } }">{{post.title}}</router-link></h3>
        <h5>{{post.created_at}}</h5>
        <div>
            {{post.body | cutbody}} 
            <router-link :to="{ name: 'viewPost', params: { id: post.id } }"><button>Czytaj dalej</button></router-link>
        </div>
    </div>
</template>
<script>
export default {
    props: [
        'post'
    ],
    
}
</script>
<template>
    <div>
         <h5><router-link :to="{ name: 'viewPost', params: { id: popularPost.id } }">{{popularPost.title}}</router-link></h5>
    </div>
</template>
<script>
export default {
    props:[
        'popularPost'
    ]
}
</script>
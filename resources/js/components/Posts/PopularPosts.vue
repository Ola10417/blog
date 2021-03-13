<template>
    <div>
         <li class="mt-1"><router-link :to="{ name: 'viewPost', params: { id: popularPost.id } }">{{popularPost.title}}</router-link></li>
    </div>
</template>
<script>
export default {
    props:[
        'popularPost'
    ]
}
</script>
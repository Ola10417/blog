<template>
    <div>
        <h3>{{post.title}}</h3>
        <h5>{{post.created_at}}</h5>
        <div>
            {{post.body}}
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
<template>
    <div v-if="authUser.role=='admin'">
        <h3>Użytkownicy</h3>
        <div v-for="user in users" :key="user.id">
            <h4>{{user.name}}</h4>
            <h4>{{user.role}}</h4>
            <h4>{{user.created_at}}</h4>

        </div>
    </div>
</template>
<script>
export default {
    data() {
              return {
                  authUser: window.authUser,
                   users:[]
              }
          },
    methods:{
        getUsers(){
            axios.get('api/users').then(response => {
                        this.users = response.data;
                        });
        }
    },
    mounted(){
        this.getUsers();
    }
}
</script>
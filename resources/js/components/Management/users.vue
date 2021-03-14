<template>
    <div v-if="authUser.role=='admin'" class="container mt-3">
        <h3>Użytkownicy</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nazwa</th>
                    <th scope="col">Rola</th>
                    <th scope="col">Data utworzenia</th>
                    <th scope="col">Edytuj</th>
                    <th scope="col">Usuń</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td>{{user.id}}</td>
                    <td>{{user.name}}</td>
                    <td>{{user.role}}</td>
                    <td>{{user.created_at | getDate}}</td>
                    <td><button class="btn btn-secondary">Edytuj</button></td>
                    
                    <td><form><button class="btn btn-warning" @click.prevent="deleteUser(user.id)">Usuń</button></form></td>
                    

                </tr>
            </tbody>
        </table>
        
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
        },
        deleteUser(id){
            axios.post('/users/destroy/'+id,{_method: 'delete'}).then(()=>{
              console.log('sukces')
              Swal.fire({
                            icon: 'success',
                            title: 'Użytkownik został usnięty!',
                            showConfirmButton: false,
                            timer: 1500
                            })
            this.getUsers()
            })
            .catch(function (error) {
              Swal.fire({
                        icon: 'error',
                        title: 'Ups...',
                        text: 'Nie możesz usunąć tego użytkownika!'
                        })             
            });
        }
    },
    mounted(){
        this.getUsers();
    }
}
</script>
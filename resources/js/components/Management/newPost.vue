<template>
    <div>
        <h3>Dodaj nowy wpis</h3>
        <div>
            <form>
            <div>
                <label>Tytuł</label>
                <input type="text" v-model="form.title" name="title">
            </div>
            <div>
                <label>Treść</label>
                <textarea v-model="form.body" name="body"></textarea>
            </div>
            <button type="submit" @click.prevent="AddPost">Zapisz</button>
            </form>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            form: new Form({
            title:'',
            body: ''
            })
        }
    },
    methods:{
        AddPost(){
            this.form.post('/posts')
            .then(()=>{
              console.log('sukces')
              Swal.fire({
                            icon: 'success',
                            title: 'Wpis został dodany!',
                            showConfirmButton: false,
                            timer: 1500
                            })
              this.form.reset();

            })
            .catch(function (error) {
              Swal.fire({
                        icon: 'error',
                        title: 'Ups...',
                        text: 'Nie masz uprawnień!'
                        })             
            });
        }
    }
}
</script>
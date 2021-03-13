<template>
    <div v-if="authUser">
        <h3>Dodaj nowy wpis</h3>
        <div>
            <form>
            <div>
                <label>Tytuł</label>
                <input type="text" v-model="form.title" name="title">
            </div>
            <div>
                <label>Treść</label>
                <ckeditor :editor="editor" v-model="form.body" name="body" :config="editorConfig"></ckeditor>
                
            </div>
            <button type="submit" @click.prevent="AddPost">Zapisz</button>
            </form>
        </div>
    </div>
</template>
<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
export default {
    data(){
        return{
            editor: ClassicEditor,
            editorConfig:{
                
                mediaEmbed: {
                    previewsInData: true
                },
                ckfinder: {
                    
                    uploadUrl: 'http://127.0.0.1:8000/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&responseType=json'
                }
            
                
            },


            form: new Form({
            title:'',
            body: ''
            }),
            authUser: window.authUser
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
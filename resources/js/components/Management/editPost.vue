<template>
    <div v-if="authUser" class="container mt-3">
        <h3>Edytuj wpis</h3>
        <div>
            <form>
            <div>
                <label style="font-size:18px;">Tytuł</label>
                <input type="text" v-model="form.title" name="title" class="form-control w-50">
            </div>
            <div class="mt-2">
                <label style="font-size:18px;">Treść</label>
                <ckeditor :editor="editor" v-model="form.body" name="body" :config="editorConfig"></ckeditor> 
                
            </div>
            
            <div class="mt-2">
                <button type="submit" @click.prevent="editPost()" class="btn btn-primary">Edytuj</button>
            </div>
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
            },
            
            form: new Form({
            title:'',
            body: ''
            }),
            authUser: window.authUser

        }
    },
    methods:{
        getPost(){
            this.form.get('/api/posts/'+this.$route.params.id).then(response => {
                this.form.fill(response.data);
              
            });
            
        },

        editPost(){
            this.form.put('/posts/'+this.$route.params.id).then(() => {
                    
                     Swal.fire(
                        'Sukces!',
                        'Wpis został edytowany!',
                        'success'
                        )
                    
                    this.$router.push('/');
                        
                        
                         
                })
                .catch(() => {
                    Swal.fire(
                        'Błąd!',
                        'Spróbuj ponownie...',
                        'error'
                        )
                });
        }
    },
    mounted(){
        this.getPost();
    }
}
</script>
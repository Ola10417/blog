<template>
    <div v-if="authUser">
        <h3>Zarządzanie stroną</h3>
        <div>
            <a href="/#/newpost"><button>Dodaj wpis</button></a>
        </div>
        <div>
            Najnowsze komentarze
        </div>
        <div>
            <a href="/register"><button>Dodaj użytkownika</button></a>
        </div>
    </div>
</template>
<script>
export default {
    data() {
              return {
                   authUser: window.authUser
              }
          },

          
}
</script>
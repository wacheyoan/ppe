<template>
  <div>
    <span v-if="isLoggedIn">
      <a @click="logout">Logout</a>
    </span>
  </div>
</template>


<script>

export default {
  name: 'Profil',
  computed : {
    isLoggedIn : function(){ return this.$store.getters.isAuthenticated}
  },
  methods: {
    async logout (){
      await this.$store.dispatch('LogOut').then(()=>{
        this.$router.push('/login')
      })
    }
  },
}
</script>

<script setup>
import { RouterLink, RouterView } from 'vue-router'
import NavBar from './components/NavBar.vue'
import Footer from './components/Footer.vue'
</script>

<template>
  <header>
    <NavBar v-if="showNavbar"></NavBar>
  </header>
  <RouterView />
  <Footer />
</template>
<script>
export default {
  computed: {
    showNavbar(){
      return !['/login','/register'].includes(this.$route.path);
    }
  }
}
</script>

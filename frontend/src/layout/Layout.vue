<template>
  <div>
      <div v-if="currentRoute === '/login'">
        <v-main>
          <router-view/>
        </v-main>
      </div>
      <div v-if="currentRoute !== '/login' ">
        <NavbarMobile/>
        <Navbar/>
        <v-main class="mt-2 mb-8 mx-4 mx-sm-16">
          <div v-if="get_cantPendientes > 0">
            <alert-pendiente :cantidad="get_cantPendientes"/>
          </div>
          <router-view/>
        </v-main>
        <Footer/>
      </div>
  </div>
</template>

<script>
import Navbar from "../components/Navbar"
import Footer from "../components/Footer";
import NavbarMobile from "../components/NavbarMobile";
import AlertPendiente from  "../components/AlertPendiente"

import {mapActions, mapGetters} from "vuex";

export default {
  components: { Footer, Navbar, NavbarMobile, AlertPendiente},

  data: () => ({
    value: 'recent',
    currentRoute: window.location.pathname
  }),

  computed: mapGetters(['getUser','get_cantPendientes']),

  mounted() {
    this.getCantidad_Pendientes();
  },

  methods: {
    ...mapActions(['getCantidadPendientes']),

    getCantidad_Pendientes(){
      console.log(this.getUser)
      this.getCantidadPendientes(this.getUser)
    },
}
}
</script>

<style>

.v-application {
  background-color: white !important;
}

@font-face {
  font-family: Montserrat-Regular;
  src: url('/fonts/Montserrat-Regular.otf');
}

@font-face {
  font-family: Montserrat-SemiBold;
  src: url('/fonts/Montserrat-SemiBold.otf');
}
@font-face {
  font-family: Montserrat-Bold;
  src: url('/fonts/Montserrat-Bold.otf');
}

.Montserrat-Regular{
  font-family: "Montserrat-Regular";
}

.Montserrat-SemiBold {
  font-family: "Montserrat-SemiBold";
}

.Montserrat-Bold {
  font-family: "Montserrat-Bold";
}
</style>

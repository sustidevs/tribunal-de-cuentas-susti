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

          <div v-if="(getArea === 'DIRECCIÓN DE REGISTRACIONES') && (getcantidad_subsidioAporteNR > 0) ">
            <alerta-registraciones :texto="getcantidad_subsidioAporteNR" />
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
import AlertaRegistraciones from "../components/AlertaRegistraciones";

import {mapActions, mapGetters} from "vuex";

export default {
  components: { Footer, Navbar, NavbarMobile, AlertPendiente, AlertaRegistraciones},

  data: () => ({
    value: 'recent',
    currentRoute: window.location.pathname
  }),

  computed: mapGetters(['getUser','get_cantPendientes','getArea', 'getcantidad_subsidioAporteNR','get_token']),

  mounted() {
    this.getUsuario();
    this.getCantidad_Pendientes();
    this.getCantidad_SubsidioAporteNR();
  },

  methods: {
    ...mapActions(['cantidadPendientes', 'cantidad_subsidioAporteNR', 'getUsuario']),

    getCantidad_SubsidioAporteNR () {
      this.cantidad_subsidioAporteNR()
    },

    getCantidad_Pendientes(){
      this.cantidadPendientes(this.getUser)
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
  font-family: "Montserrat-Regular",serif;
}

.Montserrat-SemiBold {
  font-family: "Montserrat-SemiBold",serif;
}

.Montserrat-Bold {
  font-family: "Montserrat-Bold",serif;
}
</style>

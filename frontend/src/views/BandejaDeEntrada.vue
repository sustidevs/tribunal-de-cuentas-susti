<template>
  <div>
    <titulo texto="Expedientes Pendientes" icono="mdi-bell"/>
    <alert-sucess texto="El expediente ha sido recibido con éxito" :condicion="this.aceptado"/>
    <tabla-pendientes class="mt-2" :items="allBandejaEntrada" :loading="get_finalizado"/>
    </div>
</template>
<script>
import Titulo from "../components/Titulo"
import TablaPendientes from "../components/Tablas/TablaPendientes";
import AlertSucess from "../components/AlertSucess"
import {mapActions,mapGetters} from "vuex";

export default {
  name: 'BandejaDeEntrada',
  components: {TablaPendientes, Titulo, AlertSucess},
  data() {
    return {
      BandejaEntrada: [],
      estado: 1,
      cargando:true,
    }
  },

  computed: mapGetters(['allBandejaEntrada', 'getIdUser','aceptado', 'get_finalizado']),

  mounted() {
    this.getBandeja();
  },

  methods: {
    ...mapActions(['cerrar', 'getBandejaEntrada']),

    getBandeja(){
      let bandeja = {
        estado: 1,
        bandeja: 1,
        user_id: this.$store.getters.getIdUser,
      }
      this.getBandejaEntrada(bandeja)
    },

      /**
      this.$api.post("ListadoExp", bandeja).then((response) => {
        this.BandejaEntrada = response.data;
      });**/
    }
  }
</script>
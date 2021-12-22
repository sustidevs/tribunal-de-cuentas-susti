<template>
  <div>
    <titulo texto="Expedientes con Motivo Subsidio" icono="mdi-file-document"/>
    <!-- <div class="descripcion text-justify py-4">Si desea <strong>ver detalle</strong> de expedientes con motivo subsidio, haga clic en el botón de la tabla .</div> -->
    <tabla-motivo-subsidio class="mb-15 pb-15" :items="get_expedientes" :loading="get_finalizado"/>
    </div>
</template>
<script>
import Titulo from "../components/Titulo"
import TablaMotivoSubsidio from "../components/Tablas/TablaMotivoSubsidio";
import {mapActions,mapGetters} from "vuex";

export default {
  name: 'BandejaDeEntrada',
  components: {TablaMotivoSubsidio, Titulo},
  data() {
    return {
      estado: 1,
      cargando:true,
    }
  },

  computed: mapGetters(['get_expedientes', 'getIdUser','get_aceptado', 'get_finalizado']),

  mounted() {
    this.getBandeja();
  },

  methods: {
    ...mapActions(['cerrar', 'listadoExpedientes']),

    getBandeja(){
      let bandeja = {
        estado: 1,
        bandeja: 1,
        user_id: this.$store.getters.getIdUser,
      }
      this.listadoExpedientes(bandeja)
    },
    }
  }
</script>
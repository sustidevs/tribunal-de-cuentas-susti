<template>
  <div>
    <titulo texto="Expedientes Enviados"/>
    <tabla-mis-enviados :headers="headers" :data="this.getMisEnviados" :loading="get_finalizadoEnviados"/>
  </div>
</template>

<script>
import Titulo from "../components/Titulo";
import TablaMisEnviados from "../components/Tablas/TablaMisEnviados";
import {mapActions, mapGetters} from "vuex";

export default {
  components: {Titulo, TablaMisEnviados},
  data() {
    return {
      headers: [
        {text: 'Nro. de Expediente', value: 'nro_expediente'},
        {text: 'Extracto', value: 'extracto'},
        {text: 'Motivo', value: 'motivo'},
        {text: 'Fecha Envio', value: 'fecha'},
        {text: 'Area Destino', value: 'area_destino'},
        {text: 'Usuario', value: 'nombre_usuario'},
      ],
    }
  },

  computed: mapGetters(['getMisEnviados','get_finalizadoEnviados']),

  mounted() {
    this.getExpedientesEnviados();
  },

  methods: {
    ...mapActions(['mis_enviados']),

    getExpedientesEnviados() {
      let exp = {
        user_id: null,
        area_id: this.$store.getters.getAreaId,
      }

      this.mis_enviados(exp)
    }
  },


}
</script>
<template>
  <div>
    <titulo texto="Historial Enviados"/>
    <tabla-mis-enviados :headers="headers" :data="get_expedientes" :loading="get_finalizado"/>
  </div>
</template>

<script>
import Titulo from "../../components/Titulo";
import TablaMisEnviados from "../../components/Tablas/TablaMisEnviados";
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

  computed: mapGetters(['get_expedientes','get_finalizado']),

  mounted() {
    this.historial_enviados();
  },

  methods: {
    ...mapActions(['historial_enviados']),
  },
}
</script>
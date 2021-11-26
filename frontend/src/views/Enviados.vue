<template>
  <div>
    <titulo texto="Expedientes Enviados" icono="mdi-email-fast"/>
    <div class="descripcion text-justify py-4">Si desea <strong>recuperar</strong> un expediente, haga clic en el botón de la tabla.</div>
    <tabla-enviados :headers="headers" :data="allExpedientes" :loading="get_finalizado"/>
  </div>
</template>

<script>
import Titulo from "../components/Titulo"
import {mapActions, mapGetters} from "vuex";
import TablaEnviados from "../components/Tablas/TablaEnviados";

export default {
  name: 'Enviados',
  components: {Titulo, TablaEnviados},
  data() {
    return {
      headers: [
        { text: 'Prioridad', value: 'prioridad' },
        { text: 'Nro. de Expediente', value: 'nro_expediente' },
        { text: 'Extracto', value: 'extracto' },
        { text: 'Fecha Creación', value: 'fecha_creacion' },
        { text: 'Trámite', value: 'tramite' },
        { text: 'Cuerpo', value: 'cant_cuerpos' },
        { text: 'Fojas', value: 'fojas' },
        { text: 'Recuperar', value: 'action', align: 'center', sortable: false },
        {class: "display-4"},
      ],
    }
  },

  computed: mapGetters(['allExpedientes', 'get_finalizado, getIdUser']),

  mounted() {
    this.getExpe();
  },

  methods: {
    ...mapActions(['getExpedientes']),

    getExpe(){
      let exp = {
        estado: 1,
        estado_expediente_id: 1,
        bandeja: 4,
        user_id: this.$store.getters.getIdUser,
      }
      this.getExpedientes(exp)
    },
  },

}
</script>
<style>
.descripcion {
  font-family: Montserrat-Regular;
  font-size: 23px;
}
</style>
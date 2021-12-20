<template>
  <div>
    <titulo texto="Expedientes" icono="mdi-text-box-multiple"/>
    <div class="descripcion text-justify py-4">Si desea <strong>ver detalle e historial</strong> de un expediente, haga clic en el botón de la tabla.</div>
    <tabla-expedientes class="mb-15 pb-15" :headers="headers" :data="get_todos_expedientes" :loading="get_finalizado"/>
  </div>
</template>
<script>
import Titulo from "../components/Titulo"
import TablaExpedientes from "../components/Tablas/TablaExpedientes";
import {mapActions,mapGetters} from "vuex";

export default {
  name: 'BandejaDeEntrada',
  components: {TablaExpedientes, Titulo},
  data() {
    return {
      headers: [
        {text: 'Prioridad', value: 'prioridad'},
        {text: 'Nro. de Expediente', value: 'nro_expediente'},
        {text: 'Extracto', value: 'extracto', width: "33%"},
        {text: 'Area Actual', value: 'area_actual'},
        {text: 'Fecha Creación', value: 'fecha_creacion'},
        {text: 'Trámite', value: 'tramite', width: "5%"},
        {text: 'Cuerpo', value: 'cantCuerpos', align: 'center'},
        {text: 'Fojas', value: 'fojas', align: 'center'},
        {text: 'Ver Detalles', value: 'action', align: 'center', sortable: false},
        {class: "display-4"},
      ],
      estado: 1,
      cargando:true,
    }
  },

  computed: mapGetters(['get_todos_expedientes', 'getIdUser', 'get_finalizado']),

  mounted() {
    this.todosExpedientes();
  },

  methods: {
    ...mapActions(['cerrar', 'todosExpedientes']),
  }
}
</script>
<template>
  <div>
    <titulo texto="Expedientes" icono="mdi-bell"/>
    <tabla-expedientes class="mt-2" :headers="headers" :data="todos_expp" :loading="get_finalizado"/>
  </div>
</template>
<script>
import Titulo from "../components/Titulo"
import TablaExpedientes from "../components/Tablas/TablaExpedientes";
import {mapActions,mapGetters} from "vuex";

export default {
  name: 'BandejaDeEntrada',
  components: {TablaExpedientes, Titulo, },
  data() {
    return {
      headers: [
        {text: 'Prioridad', value: 'prioridad'},
        {text: 'Nro. de Expediente', value: 'nro_expediente'},
        {text: 'Extracto', value: 'extracto'},
        {text: 'Fecha Creación', value: 'fecha_creacion'},
        {text: 'Trámite', value: 'tramite'},
        {text: 'Cuerpo', value: 'cant_cuerpos'},
        {text: 'Fojas', value: 'fojas'},
        {class: "display-4"},
      ],
      estado: 1,
      cargando:true,
    }
  },

  computed: mapGetters(['todos_expp', 'getIdUser', 'get_finalizado']),

  mounted() {
    this.todos_exp();
  },

  methods: {
    ...mapActions(['cerrar', 'todos_exp']),
  }
}
</script>
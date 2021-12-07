<template>
  <div>
    <titulo texto="Cedulas" icono="mdi-credit-card-edit"/>
    <div class="descripcion text-justify py-4">Si desea <strong>agregar una cedula</strong> a un expediente, haga clic en el botón de la tabla.</div>
    <tabla-cedulas class="mb-15 pb-15" :headers="headers" :data="todos_expp" :loading="get_finalizado"/>
  </div>
</template>
<script>
import Titulo from "../components/Titulo"
import TablaCedulas from "../components/Tablas/TablaCedulas";
import {mapActions,mapGetters} from "vuex";

export default {
  name: 'Cedula',
  components: {TablaCedulas, Titulo, },
  data() {
    return {
      headers: [
        {text: 'Prioridad', value: 'prioridad'},
        {text: 'Nro. de Expediente', value: 'nro_expediente'},
        {text: 'Extracto', value: 'extracto'},
        {text: 'Fecha Creación', value: 'fecha_creacion'},
        {text: 'Trámite', value: 'tramite'},
        {text: 'Cuerpo', value: 'cuerpos'},
        {text: 'Fojas', value: 'fojas'},
        {text: 'Agregar Cedula', value: 'action', align: 'center', sortable: false},
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
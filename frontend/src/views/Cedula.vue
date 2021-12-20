<template>
  <div>
    <titulo texto="Cédulas" icono="mdi-credit-card-edit"/>
    <div class="descripcion text-justify py-4">Si desea <strong>agregar una cédula</strong> a un expediente, haga clic en el botón de la tabla.</div>
    <!-- <alert-sucess texto="La cédula ha sido cargada con exito" :condicion="this.cargando"/> -->
    <tabla-cedulas class="mb-15 pb-15" :headers="headers" :data="get_expedientes" :loading="get_finalizado"/>
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
        {text: 'Agregar Cédula', value: 'action', align: 'center', sortable: false},
        {class: "display-4"},
      ],
      estado: 1,
    }
  },

  computed: mapGetters(['get_expedientes', 'get_finalizado']),

  mounted() {
    this.getExpe();
  },

  methods: {
    ...mapActions(['listadoExpedientes','getIdUser']),

    getExpe(){
      let exp = {
        estado: 3,
        bandeja: 3,
        user_id: this.$store.getters.getIdUser,
      }
      this.listadoExpedientes(exp)
    },

  },
}
</script>
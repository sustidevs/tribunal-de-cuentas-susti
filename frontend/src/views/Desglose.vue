<template>
  <div>
    <titulo texto="Desglose" icono="mdi-text-box-multiple"/>
    <tabla-desglose :headers="headers" :data="getExpedientesPadres"/>
  </div>
</template>

<script>
import Titulo from "../components/Titulo";
import TablaDesglose from "../components/Tablas/TablaDesglose";
import {mapActions, mapGetters} from "vuex";


export default {
  components: {Titulo, TablaDesglose},

  data() {
    return {
      headers: [
        {text: 'Nro. de Expediente', value: 'nro_expediente'},
        {text: 'Extracto', value: 'extracto'},
        {text: 'Ver Hijos', value: 'action', sortable: false},
      ],
    }
  },

  computed: mapGetters(['get_finalizado', 'getExpedientesPadres']),

  mounted() {
    this.desglosarVerPadres();
  },

  methods: {
    ...mapActions(['desglosarVerPadres','cerrar','getIdUser']),

  },

}
</script>
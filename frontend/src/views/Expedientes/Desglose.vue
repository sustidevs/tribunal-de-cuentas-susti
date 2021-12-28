<template>
  <div>
    <titulo texto="Desglose" icono="mdi-file-percent"/>
    <div class="descripcion text-justify py-4">Si desea <strong>desglosar</strong> un expediente, seleccione el mismo de la lista.</div>
    <tabla-desglose :headers="headers" :data="getExpedientesPadres"/>
  </div>
</template>

<script>
import Titulo from "../../components/Titulo";
import TablaDesglose from "../../components/Tablas/TablaDesglose";
import {mapActions, mapGetters} from "vuex";

export default {
  components: {Titulo, TablaDesglose},

  data() {
    return {
      headers: [
        {text: 'Nro. de Expediente', value: 'nro_expediente'},
        {text: 'Extracto', value: 'extracto'},
        {text: 'Seleccionar', value: 'action', sortable: false},
      ],
    }
  },

  computed: mapGetters(['get_finalizado', 'getExpedientesPadres']),

  mounted() {
    this.desglosarVerPadres();
  },

  methods: {
    ...mapActions(['desglosarVerPadres','cerrar']),
  },

}
</script>
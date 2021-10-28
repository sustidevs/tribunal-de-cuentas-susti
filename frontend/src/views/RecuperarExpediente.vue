<template>
  <div>
    <alert texto="El expediente fue recuperado con éxito." :condicion="this.recuperado" />
    <titulo texto="Recuperar"/>
    <tabla-mis-expedientes :headers="headers" :data="allExpedientes" :loading="get_finalizado"/>
    <tabla-recuperar/>
  </div>
</template>
<script>
import Titulo from "../components/Titulo"
import Alert from "../components/Alert"
import TablaRecuperar from "../components/Tablas/TablaRecuperar";
import {mapActions, mapGetters} from "vuex";
export default {
  name: 'BandejaDeEntrada',
  components: {Titulo, Alert,TablaRecuperar},
  data() {
    return {
      headers: [
        { text: 'Nro. de Expediente', value: 'nroexpediente' },
        { text: 'Extracto', value: 'extracto' },
        { text: 'Trámite', value: 'tramite' },
        { text: 'Fecha envío', value: 'fechaenv' },
        { text: 'Área destino', value: 'areadest' },
        { text: 'Cuerpo', value: 'cuerpo' },
      ],
    }
  },

  computed: mapGetters(['allExpedientes', 'get_finalizado']),

  mounted() {
    this.getExpe();
  },

  methods: {
    ...mapActions(['getExpedientes','cerrar','getIdUser']),

    getExpe(){
      let exp = {
        estado: 4,
        bandeja: 4,
        user_id: this.$store.getters.getIdUser,
      }
      this.getExpedientes(exp)
    },

    /**
     this.$api.post("ListadoExp", bandeja).then((response) => {
        this.BandejaEntrada = response.data;
      });**/
  },
}
</script>
<template>
  <div>
    <titulo texto="Desglose" icono="mdi-text-box-multiple"/>
    <tabla-desglose :headers="headers" :data="allExpedientes"/>
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

  computed: mapGetters(['allExpedientes', 'get_finalizado']),

  mounted() {
    this.getExpe();
  },

  methods: {
    ...mapActions(['getExpedientes','cerrar','getIdUser']),

    getExpe(){
      let exp = {
        estado: 3,
        bandeja: 3,
        user_id: this.$store.getters.getIdUser,
      }
      this.getExpedientes(exp)
    },
  },

}
</script>
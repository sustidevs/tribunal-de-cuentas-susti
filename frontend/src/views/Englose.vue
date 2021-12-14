<template>
  <div>
    <titulo texto="Englose" icono="mdi-text-box-multiple"/>
    <englose :headers="headers" :data="allExpedientes"/>
  </div>
</template>

<script>
import Englose from "../components/Tablas/TablaEnglose"
import Titulo from "../components/Titulo";
import {mapActions, mapGetters} from "vuex";

export default {
  components:{Englose,Titulo},

  data() {
    return {
      headers: [
        {text: 'Nro. de Expediente', value: 'nro_expediente'},
        {text: 'Extracto', value: 'extracto'},
        {text: 'Seleccionar', value: 'action', sortable: false},
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
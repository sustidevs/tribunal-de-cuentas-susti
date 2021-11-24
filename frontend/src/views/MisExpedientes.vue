<template>
  <div>
    <titulo texto="Mis Expedientes" icono="mdi-file-document" />
    <div class="descripcion text-justify py-4">Si desea <strong>realizar un pase</strong>, haga clic en el botón de la tabla.</div>
    <alert-sucess texto="El expediente ha sido asignado con éxito" :condicion="this.$store.getters.asignado"/>
    <tabla-mis-expedientes :headers="headers" :data="allExpedientes" :loading="get_finalizado"/>
  </div>
</template>

<script>
import Titulo from "../components/Titulo"
import {mapActions, mapGetters} from "vuex";
import TablaMisExpedientes from "../components/Tablas/TablaMisExpedientes";
import AlertSucess from "../components/AlertSucess"

export default {
  name: 'MisExpedientes',
  components: {TablaMisExpedientes, Titulo, AlertSucess},
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
        {text: 'Realizar Pase', value: 'action', sortable: false},
        {class: "display-4"},
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

      /**
       this.$api.post("ListadoExp", bandeja).then((response) => {
        this.BandejaEntrada = response.data;
      });**/
  },

  /**
  mounted() {
    this.$api.get('/e').then((response) => {
      console.log(response)
      this.datos = response.data; //se crea un array para guardar el contenido que devuelva el response
    })
        .catch(function (error){
          console.log(error);
        });
  }**/
}
</script>

<template>
  <div class="pb-16">
    <div class="pb-16">
      <v-row no-gutters justify="start" class="pt-5">
        <titulo-area-sub :area="this.$store.getters.getArea" class="mb-2"/>
      </v-row>
      <v-divider color="#393B44" class="my-4"></v-divider>

      <div v-if="getArea == 'DPTO. MESA DE ENTRADAS Y SALIDAS'">
        <v-row class="phone">
          <v-col cols="12" sm="12" lg="6">
            <titulo-inicio texto="Bandejas" class="my-2"/>
            <ButtonBig class="my-4 mx-5" texto="Pendientes" link="/expedientes-pendientes" icon="mdi-clock"/>
            <ButtonBig class="my-4 mx-5" texto="Expedientes" link="/expedientes" icon="mdi-archive"/>
            <ButtonBig class="my-4 mx-5" texto="Enviados"  link="/enviados" icon="mdi-file-send"/>
          </v-col>
          <v-col cols="12" sm="12" lg="6">
            <titulo-inicio texto="Expedientes" class="my-2"/>
            <ButtonBig class="my-4 mx-5" texto="Pase" link="/mis-expedientes" icon="mdi-file-move"/>
          </v-col>
        </v-row>

        <v-divider color="#393B44" class="mt-10 d-none d-sm-block"></v-divider>

        <v-row class="phone mt-4">
          <v-col cols="12" sm="12" lg="6">
            <titulo-inicio texto="Nuevo" class="my-2"/>
            <ButtonBig class="my-4 mx-5" texto="Expediente" link="/nuevo-expediente" icon="mdi-text-box-plus"/>
            <ButtonBig class="my-4 mx-5" texto="Iniciador" link="/nuevo-iniciador" icon="mdi-account-plus"/>
          </v-col>
          <v-col cols="12" sm="12" lg="6">
            <titulo-inicio texto="Consultar" class="my-2"/>
            <ButtonBig class="my-4 mx-5" texto="Iniciador" link="" icon="mdi-account-question"/>
            <v-hover v-slot="{ hover }" >
              <v-btn
                  rounded
                  width="150"
                  height="150"
                  @click="abrirModalConsultar()"
                  :class="hover ? 'orange accent-1' : 'grey lighten-3'"
                  class="pa-8 mx-5 Montserrat-Bold grey--text text--darken-3"
              >
                <div class="d-flex flex-column justify-center">
                  <v-icon size="70" class="py-2" :color="hover ? 'grey darken-1' : '#FDBC3F'">mdi-magnify</v-icon>

                  <div class="sizeBig pt-4">
                    Expediente
                  </div>
                </div>
              </v-btn>
            </v-hover>
            <modal-consultar-nro-exp :show="showModalConsultarNroExp" @close="closeModalConsultarNroExp"/>
          </v-col>
        </v-row>
      </div>

      <div v-else>
        <v-row  class="phone mt-4">
          <v-col cols="12" md="12" lg="6">
            <titulo-inicio texto="Bandejas" class="my-2"/>
            <ButtonBig class="my-4 mx-5" texto="Pendientes" link="/expedientes-pendientes" icon="mdi-clock"/>
            <ButtonBig class="my-4 mx-5" texto="Expedientes" link="/expedientes" icon="mdi-archive"/>
            <ButtonBig class="my-4 mx-5" texto="Enviados"  link="/enviados" icon="mdi-file-send"/>
          </v-col>
          <v-col cols="12" md="12" lg="6">
            <titulo-inicio texto="Consultar" class="my-2"/>
            <v-hover v-slot="{ hover }" >
              <v-btn
                  rounded
                  width="150"
                  height="150"
                  @click="abrirModalConsultar()"
                  :class="hover ? 'orange accent-1' : 'grey lighten-3'"
                  class="pa-8 my-4 mx-5 Montserrat-Bold grey--text text--darken-3"
              >
                <div class="d-flex flex-column justify-center">
                  <v-icon size="70" class="py-2" :color="hover ? 'grey darken-1' : '#FDBC3F'">mdi-magnify</v-icon>

                  <div class="sizeBig pt-4">
                    Expediente
                  </div>
                </div>
              </v-btn>
            </v-hover>
            <modal-consultar-nro-exp :show="showModalConsultarNroExp" @close="closeModalConsultarNroExp"/>
          </v-col>
        </v-row>

        <v-divider color="#393B44" class="mt-2 mt-12 d-none d-sm-block"></v-divider>

        <v-row  class="phone mt-4">
          <v-col cols="12" md="12" lg="6">
            <titulo-inicio texto="Expedientes" class="my-2"/>
            <ButtonBig class="my-4 mx-5" texto="Pase" link="/mis-expedientes" icon="mdi-file-move"/>
            
            <span v-if="getArea == 'VOCALIA A'" >
              <ButtonBig class="my-4 mx-5" texto="Englose" link="/englose" icon="mdi-file-plus"/>
              <ButtonBig class="my-4 mx-5" texto="Desglose" link="" icon="mdi-file-percent"/>
            </span>
            <span v-if="getArea == 'VOCALIA B'" >
              <ButtonBig class="my-4 mx-5" texto="Englose" link="/englose" icon="mdi-file-plus"/>
              <ButtonBig class="my-4 mx-5" texto="Desglose" link="" icon="mdi-file-percent"/>
            </span>
            <span v-if="getArea == 'VOCALIA C'" >
              <ButtonBig class="my-4 mx-5" texto="Englose" link="/englose" icon="mdi-file-plus"/>
              <ButtonBig class="my-4 mx-5" texto="Desglose" link="" icon="mdi-file-percent"/>
            </span>
            <span v-if="getArea == 'VOCALIA D'" >
                <ButtonBig class="my-4 mx-5" texto="Englose" link="/englose" icon="mdi-file-plus"/>
                <ButtonBig class="my-4 mx-5" texto="Desglose" link="" icon="mdi-file-percent"/>
            </span>
            <span v-if="getArea == 'RELATORIA A'" >
                <ButtonBig class="my-4 mx-5" texto="Englose" link="/englose" icon="mdi-file-plus"/>
                <ButtonBig class="my-4 mx-5" texto="Desglose" link="" icon="mdi-file-percent"/>
            </span>
            <span v-if="getArea == 'RELATORIA B'" >
                <ButtonBig class="my-4 mx-5" texto="Englose" link="/englose" icon="mdi-file-plus"/>
                <ButtonBig class="my-4 mx-5" texto="Desglose" link="" icon="mdi-file-percent"/>
            </span>
            <span v-if="getArea == 'RELATORIA C'" >
                <ButtonBig class="my-4 mx-5" texto="Englose" link="/englose" icon="mdi-file-plus"/>
                <ButtonBig class="my-4 mx-5" texto="Desglose" link="" icon="mdi-file-percent"/>
            </span>
            <span v-if="getArea == 'RELATORIA D'" >
                <ButtonBig class="my-4 mx-5" texto="Englose" link="/englose" icon="mdi-file-plus"/>
                <ButtonBig class="my-4 mx-5" texto="Desglose" link="" icon="mdi-file-percent"/>
            </span>          
          </v-col>

          <v-col cols="12" md="12" lg="6" v-if="getArea == 'DIRECCIÓN DE REGISTRACIONES'">
            <titulo-inicio texto="Cedulas" class="my-2"/>
            <ButtonBig class="my-4 mx-5" texto="Cedula"  link="/cedula" icon="mdi-card-account-details"/>
          </v-col>

        </v-row>
      </div>


      <!--<v-row>
        <v-col cols="12" sm="6" lg="3">
          <boton-horizontal link="/nuevo-expediente" texto="Nuevo Expediente" icono="mdi-file-plus-outline" alto="55" ancho="100%"/>
        </v-col>
        <v-col cols="12" sm="6" lg="3">
          <v-hover v-slot="{ hover }" >
            <v-btn
              :class="hover ? 'orange accent-1' : 'grey lighten-2'"
              class="pa-8 Montserrat-Bold grey--text text--darken-3"
              @click="abrirModalConsultar()"
              width="100%"
            >
              <v-icon class="px-4" left large color="#393B44">
                mdi-text-box-search-outline
              </v-icon>
              Consultar Expediente
            </v-btn>
          </v-hover>
        </v-col>
        <v-col cols="12" sm="6" lg="3">
          <boton-horizontal  @click="cargar()" link="/bandeja" texto="Bandeja de Entrada" icono="mdi-bell-outline" alto="55" ancho="100%"/>
        </v-col>
        <v-col cols="12" sm="6" lg="3">
          <boton-horizontal link="/mis-expedientes-asignados" texto="Realizar Pase" icono="mdi-file-send-outline" alto="55" ancho="100%"/>
        </v-col>
      </v-row>
      <titulo-inicio texto="Expedientes" class="my-6"/>
      <v-row>
        <v-col cols="12">
          <boton-vertical :datos="expedientes"/>
        </v-col>
      </v-row>

      <v-row>
        <v-col cols="12" lg="6">
          <titulo-inicio texto="Documentos Oficiales" class="my-6"/>
          <boton-vertical :datos="documentos"/>
        </v-col>
        <v-col cols="12" lg="6">
          <titulo-inicio texto="Comunicaciones Oficiales" class="my-6"/>
          <boton-vertical :datos="comunicaciones"/>
        </v-col>
      </v-row>-->
    </div>
  </div>
</template>

<script>
import TituloInicio from "../components/TituloInicio"
import TituloAreaSub from "../components/TituloAreaSub"
import ModalConsultarNroExp from "../components/dialogs/ModalConsultarNroExp"
import ButtonBig from "../components/ButtonBig"

import {mapActions, mapGetters} from "vuex";

  export default {
    name: 'Home',
    components: {TituloInicio,TituloAreaSub, ModalConsultarNroExp, ButtonBig},
    data () {
    return {

      bandeja: {
        estado: 1,
        bandeja: 1,
        user_id: this.$store.getters.getIdUser
      },

      showModalConsultarNroExp: false,
      estado: {
        idTipo: "1",
      },
      cuil:'',
      expedientes: [
        {
          titulo: "Expedientes",
          descripcion:"Consulte todos los expedientes que han sido recibidos de bandeja de entrada y no estan asignados a nadie",
          imagen: "./img/cards/ver-todos.svg",
          botonText: "Ver Expedientes",
          link: "/expedientes",
        },
        {
          titulo: "Mis Expedientes",
          descripcion:"Seleccione uno de sus expedientes a cargo para realizar el pase del mismo",
          imagen: "./img/cards/ver-todos.svg",
          botonText: "Ver Mis Expedientes",
          link: "/mis-expedientes-asignados",
        },

        
        {
          titulo: "Seguimientos",
          descripcion:"Consulte el historial de pases de los expedientes",
          imagen: "./img/cards/seguimientos.svg",
          botonText: "Ver Seguimientos",
          link: "/seguimientos"
        },
        /**
        {
          titulo: "Archivados",
          imagen: "./img/cards/archivados.svg",
        },**/
      ],
      documentos: [
        {
          texto: "Normativas",
          imagen: "./img/cards/normativas.svg",
        },
        {
          texto: "Generar",
          imagen: "./img/cards/generar.svg",
        },
      ],
      comunicaciones: [
        {
          texto: "Reuniones",
          imagen: "./img/cards/reuniones.svg",
        },
        {
          texto: "Novedades",
          imagen: "./img/cards/novedades.svg",
        },
      ],
    }
  },

  computed: mapGetters(['getTipoUsuario','getArea']),

  methods:{
    ...mapActions([ 'getSubArea','getUser', 'getBandejaEntrada']),

    /**
    cargar () {
      let bandeja = {
        estado: 1,
        bandeja: 1,
        user_id: this.$store.getters.getIdUser
      }
    },**/

    abrirModalConsultar() {
        this.showModalConsultarNroExp=!this.showModalConsultarNroExp
    },

    closeModalConsultarNroExp() {
        this.showModalConsultarNroExp = false;
      },
  },

}
</script>

<style>
@media only screen and (max-width: 600px) {
  .phone {
    text-align: center;
    padding: 70px 0;}
}
</style>
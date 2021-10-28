<template>
  <div>
    <div>
      <v-row no-gutters justify="start" class="pt-5">
        <titulo-area-sub :area="this.$store.getters.getArea"  class="mb-2"/>
      </v-row>
      <v-divider color="#393B44" class="mt-2"></v-divider>

      <titulo-inicio texto="Expedientes" class="my-6"/>
      <div class="d-flex flex-row">
        <div class="pr-5">
          <ButtonBig texto="Nuevo" link="/nuevo-expediente" :imagen="'./img/cards/nuevoexpediente.png'"/>
        </div>
        <div class="mx-5">
          <v-hover v-slot="{ hover }" >
            <v-btn
                rounded
                width="190"
                height="190"
                @click="abrirModalConsultar()"
                :class="hover ? 'orange accent-1' : 'grey lighten-2'"
                class="pa-8 Montserrat-Bold grey--text text--darken-3"
            >
              <div class="d-flex flex-column justify-center">
                <div>
                  <v-img class="py-2" max-height="130" width="130" :src="'./img/cards/consultar.png'"></v-img>
                </div>

                <div class="sizeBig pt-4">
                  Consultar
                </div>
              </div>
            </v-btn>
          </v-hover>
          <modal-consultar-nro-exp :show="showModalConsultarNroExp" @close="closeModalConsultarNroExp"/>
        </div>
        <div class="mx-5">
          <ButtonBig texto="Realizar Pase" link="/mis-expedientes" :imagen="'./img/cards/nuevopase.png'"/>
        </div>
        <div class="mx-5"> 
          <ButtonBig texto="Recuperar" link="/recuperar-expediente" :imagen="'./img/cards/recuperar.png'"/>
        </div>
      </div>

      <v-divider color="#393B44" class="mt-2 mt-12"></v-divider>

      <titulo-inicio texto="Bandejas" class="my-6"/>
      <div class="d-flex flex-row">
        <div class="pr-5">
          <ButtonBig  texto="Pendientes" link="/expedientes-pendientes" :imagen="'./img/cards/pendientes.png'" />
        </div>
        <div class="mx-5">
          <ButtonBig texto="Mis Expedientes" link="/mis-expedientes"  :imagen="'./img/cards/misexpediente.png'"/>
        </div>
        <div class="mx-5">
          <ButtonBig texto="Expedientes" link="/expedientes"  :imagen="'./img/cards/expedientes.png'"/>
        </div>
        <div class="mx-5">
          <ButtonBig texto="Historiales"  link="/historial"  :imagen="'./img/cards/historial.png'"/>
        </div>
      </div>

      <div v-if="this.getTipoUsuario === 'Administrador Area'">
        <v-divider color="#393B44" class="my-8"></v-divider>
        <titulo-inicio texto="Acciones de Administrador" class="my-6"/>
        <div class="d-flex flex-row">
          <div class="pr-5">
            <ButtonBig texto="Nuevo iniciador" link="/nuevo-iniciador" :imagen="'./img/cards/iniciador.png'"/>
          </div>
        </div>
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

    computed: mapGetters(['getTipoUsuario']),

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
<template>
  <div class="pb-16 mb-16">
    <overlay :loading="get_btn_login"/>
    {{get_area}}
    <v-row no-gutters justify="start" class="pt-5">
      <titulo-area-sub :area="get_user.area" class="mb-2"/>
    </v-row>
    <v-divider color="#393B44" class="my-4"></v-divider>

    <div v-if="get_user.area === 'DPTO. MESA DE ENTRADAS Y SALIDAS'">
      <v-row class="phone">

        <v-col cols="12" sm="12" lg="7" md="12" xs="12">
          <titulo-inicio texto="Bandejas" class="my-2"/>
          <ButtonBig class="my-4 mx-5" texto="Pendientes" link="/expedientes-pendientes" icon="mdi-clock"/>
          <ButtonBig class="my-4 mx-5" texto="Expedientes" link="/expedientes" icon="mdi-archive"/>
          <ButtonBig class="my-4 mx-5" texto="Enviados" link="/mis-enviados" icon="mdi-file-send"/>
        </v-col>

        <v-col cols="12" sm="12" lg="5" md="12" xs="12">
          <titulo-inicio texto="Iniciadores" class="mt-5"/>
            <ButtonBig class="my-4 mx-5" texto="Nuevo" link="/nuevo-iniciador" icon="mdi-account-plus"/>
            <ButtonBig class="my-4 mx-5" texto="Ver todos" link="/iniciadores" icon="mdi-account-group"/>
        </v-col>
      </v-row>

      <v-divider color="#393B44" class="mt-10 d-none d-sm-block"></v-divider>

      <v-row class="phone">
        <v-col cols="12" md="12" lg="7" sm="12" xs="12">
          <titulo-inicio texto="Expedientes" class="my-2 mt-5"/>
          <v-hover v-slot="{ hover }">
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
                  Consultar
                </div>
              </div>
            </v-btn>
          </v-hover>
          <modal-consultar-nro-exp :show="showModalConsultarNroExp" @close="closeModalConsultarNroExp"/>
          <ButtonBig class="my-4 mx-5" texto="Nuevo" link="/nuevo-expediente" icon="mdi-text-box-plus"/>
          <ButtonBig class="my-4 mx-5" texto="Pase" link="/mis-expedientes" icon="mdi-file-move"/>
          <ButtonBig class="my-4 mx-5" texto="Recuperar" link="/recuperar" icon="mdi-file-undo"/>
        </v-col>
        <v-col cols="12" md="12" lg="5" sm="12" xs="12">
          <titulo-inicio texto="Cédulas" class="my-2 mt-5"/>
          <ButtonBig class="my-4 mx-5" texto="Cédula" link="/cedula" icon="mdi-card-account-details"/>
        </v-col>
      </v-row>
    </div>

    <div v-else>
      <v-row class="phone mt-4">
        <v-col cols="12" md="12" lg="7" sm="12" xs="12">
          <titulo-inicio texto="Bandejas" class="my-2"/>
          <ButtonBig class="my-4 mx-5" texto="Pendientes" link="/expedientes-pendientes" icon="mdi-clock"/>
          <ButtonBig class="my-4 mx-5" texto="Expedientes" link="/expedientes" icon="mdi-archive"/>
          <ButtonBig class="my-4 mx-5" texto="Enviados" link="/mis-enviados" icon="mdi-file-send"/>
        </v-col>
        <v-col cols="12" md="12" lg="5" sm="12">
          <titulo-inicio texto="Consultar" class="my-2"/>
          <v-hover v-slot="{ hover }">
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

      <v-row class="phone mt-4">
        <v-col cols="12" md="12" lg="7" sm="12" xs="12">
          <titulo-inicio texto="Expedientes" class="my-2"/>
          <ButtonBig class="my-4 mx-5" texto="Pase" link="/mis-expedientes" icon="mdi-file-move"/>
          <ButtonBig class="my-4 mx-5" texto="Recuperar" link="/recuperar" icon="mdi-file-undo"/>

          <span v-if="(get_user.area == 'VOCALIA A')">
              <ButtonBig class="my-4 mx-5" texto="Englose" link="/englose" icon="mdi-file-plus"/>
              <ButtonBig class="my-4 mx-5" texto="Desglose" link="/desglose" icon="mdi-file-percent"/>
            </span>
          <span v-if="get_user.area == 'VOCALIA B'">
              <ButtonBig class="my-4 mx-5" texto="Englose" link="/englose" icon="mdi-file-plus"/>
              <ButtonBig class="my-4 mx-5" texto="Desglose" link="/desglose" icon="mdi-file-percent"/>
            </span>
          <span v-if="get_user.area == 'VOCALIA C'">
              <ButtonBig class="my-4 mx-5" texto="Englose" link="/englose" icon="mdi-file-plus"/>
              <ButtonBig class="my-4 mx-5" texto="Desglose" link="/desglose" icon="mdi-file-percent"/>
            </span>
          <span v-if="get_user.area == 'VOCALIA D'">
                <ButtonBig class="my-4 mx-5" texto="Englose" link="/englose" icon="mdi-file-plus"/>
                <ButtonBig class="my-4 mx-5" texto="Desglose" link="/desglose" icon="mdi-file-percent"/>
            </span>
          <span v-if="get_user.area == 'RELATORIA A'">
                <ButtonBig class="my-4 mx-5" texto="Englose" link="/englose" icon="mdi-file-plus"/>
                <ButtonBig class="my-4 mx-5" texto="Desglose" link="/desglose" icon="mdi-file-percent"/>
            </span>
          <span v-if="get_user.area == 'RELATORIA B'">
                <ButtonBig class="my-4 mx-5" texto="Englose" link="/englose" icon="mdi-file-plus"/>
                <ButtonBig class="my-4 mx-5" texto="Desglose" link="/desglose" icon="mdi-file-percent"/>
            </span>
          <span v-if="get_user.area == 'RELATORIA C'">
                <ButtonBig class="my-4 mx-5" texto="Englose" link="/englose" icon="mdi-file-plus"/>
                <ButtonBig class="my-4 mx-5" texto="Desglose" link="/desglose" icon="mdi-file-percent"/>
            </span>
          <span v-if="get_user.area == 'RELATORIA D'">
                <ButtonBig class="my-4 mx-5" texto="Englose" link="/englose" icon="mdi-file-plus"/>
                <ButtonBig class="my-4 mx-5" texto="Desglose" link="/desglose" icon="mdi-file-percent"/>
            </span>
        </v-col>

        <v-col cols="12" md="12" lg="5" sm="12" xs="12" v-if="get_user.area == 'DIRECCIÓN DE REGISTRACIONES'">
          <titulo-inicio texto="Cédulas" class="my-2"/>
          <ButtonBig class="my-4 mx-5" texto="Cédula" link="/cedula" icon="mdi-card-account-details"/>
        </v-col> 

      </v-row>
    </div>
  </div>
</template>

<script>
import TituloInicio from "../components/TituloInicio"
import TituloAreaSub from "../components/TituloAreaSub"
import ModalConsultarNroExp from "../components/dialogs/ModalConsultarNroExp"
import ButtonBig from "../components/ButtonBig"
import Overlay from "../components/Overlay";

import {mapGetters} from "vuex";

export default {
  name: 'Home',
  components: {TituloInicio, TituloAreaSub, ModalConsultarNroExp, ButtonBig, Overlay},
  data() {
    return {
      showModalConsultarNroExp: false,
      expedientes: [
        {
          titulo: "Expedientes",
          descripcion: "Consulte todos los expedientes que han sido recibidos de bandeja de entrada y no estan asignados a nadie",
          imagen: "./img/cards/ver-todos.svg",
          botonText: "Ver Expedientes",
          link: "/expedientes",
        },
        {
          titulo: "Mis Expedientes",
          descripcion: "Seleccione uno de sus expedientes a cargo para realizar el pase del mismo",
          imagen: "./img/cards/ver-todos.svg",
          botonText: "Ver Mis Expedientes",
          link: "/mis-expedientes-asignados",
        },
        {
          titulo: "Seguimientos",
          descripcion: "Consulte el historial de pases de los expedientes",
          imagen: "./img/cards/seguimientos.svg",
          botonText: "Ver Seguimientos",
          link: "/seguimientos"
        },
      ],
    }
  },

  computed: mapGetters(['get_user','get_authenticated','get_btn_login','get_area']),

  methods: {
    abrirModalConsultar() {
      this.showModalConsultarNroExp = !this.showModalConsultarNroExp
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
    padding: 20px 0;
  }
}
</style>
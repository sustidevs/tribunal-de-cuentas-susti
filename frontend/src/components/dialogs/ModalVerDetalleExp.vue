<template>
  <v-dialog v-model="show" width="1200px" content-class="round">
    <v-card class="px-7 pt-1">
        <titulo texto="Expediente N° 800 - 28-04 - 1000/2021" icono="mdi-file-document"/>

      <v-card outlined class="my-5 pa-5" color="grey lighten-3">
        <v-row no-gutters align="start">
          <v-col>
            <div class="d-flex">
              <div class="textHereSmall Montserrat-Bold mr-1"> Iniciador: </div>
              <div class="textHereSmall Montserrat-SemiBold ml-1"> Ministerio de Hacienda y Finanzas </div>
            </div>
          </v-col>
          <v-col>
            <div class="d-flex">
              <div class="textHereSmall Montserrat-Bold mr-1"> Fecha de creación: </div>
              <div class="textHereSmall Montserrat-SemiBold ml-1"> 28/04/2021 </div>
            </div>
          </v-col>
        </v-row>

        <v-row no-gutters align="start" class="mt-5">
          <div class="textHereSmall d-flex flex-column Montserrat-Bold mb-2"> Extracto: </div>
          <div class="textHereSmall d-flex flex-column Montserrat-SemiBold text-justify">RENDICIÓN DE CUENTAS N° 01/20 FDO.PTE.GTOS.BIENES DE CONSUMO
            SERVICIOS NO RESPONSABLE. BS. USO Y TRANF. DCTO M° 2548/20. $1.000.000.00 (MINISTERIO REPARTICIÓN).
          </div>
        </v-row>
      </v-card>


        <v-row no-gutters align="start" class="mt-5">
            <v-col>
                <div class="d-flex">
                    <div class="textHereSmall Montserrat-Bold mr-1"> Área emisora: </div>
                    <div class="textHereSmall Montserrat-SemiBold ml-1"> Secretaría General Técnica </div>
                </div>
            </v-col>
            <v-col>
                <div class="d-flex">
                    <div class="textHereSmall Montserrat-Bold mr-1"> Cuerpo: </div>
                    <div class="textHereSmall Montserrat-SemiBold ml-1"> 3</div>
                </div>
            </v-col>
        </v-row>
        <v-row no-gutters align="start" class="mt-5">
            <v-col>
                <div class="d-flex">
                    <div class="textHereSmall Montserrat-Bold mr-1"> Trámite: </div>
                    <div class="textHereSmall Montserrat-SemiBold ml-1"> Fondo Permanente </div>
                </div>
            </v-col>
            <v-col>
                <div class="d-flex">
                    <div class="textHereSmall Montserrat-Bold mr-1"> Fojas: </div>
                    <div class="textHereSmall Montserrat-SemiBold ml-1"> 15</div>
                </div>
            </v-col>
        </v-row>

      <v-row no-gutters align="start" class="mt-5">
        <div class="textHereSmall d-flex flex-column Montserrat-Bold mb-2"> A efectos de: </div>
        <div class="textHereSmall d-flex flex-column Montserrat-SemiBold text-justify"> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
      </v-row>
              <v-hover v-slot="{ hover }" >
                <div :class="hover ? 'orange--text text--accent-1' : 'black--text'"  class="descargar Montserrat-Regular pt-4" @click="getArchiv()">
                  <div class="textHereSmall Montserrat-Bold mr-3 pb-4"> Archivos adjuntos: </div>
                  <v-icon :class="hover ? 'orange--text text--accent-1' : 'black--text'" class="px-5">mdi-download-multiple</v-icon>Descargar
                </div>
              </v-hover>

        <v-row no-gutters justify="center" class="mt-8">
            <v-col cols="12" sm="6" md="6" lg="6" class="py-6 px-sm-2">
                <v-btn @click="close" class="pa-5 color Montserrat-SemiBold" height="55" elevation="0" color="#FACD89" block>
                    <v-icon class="px-5"> mdi-check-bold </v-icon>
                    Cerrar
                </v-btn>
            </v-col>
        </v-row>
    </v-card>
  </v-dialog>
</template>
<script>
import Titulo from "../Titulo"
import {mapActions, mapGetters} from "vuex";
export default {
    name: 'ModalVerDetalleExp',
    components: {Titulo},
    props: {
        show: {type: Boolean, default:false},
        expediente_id: Number,
        nro_expediente: String,
    },

    computed: mapGetters(['allExpedientes', 'get_archivos']),

    methods: {
        ...mapActions([ 'getExpedientes', 'getArchivos']),

        getArchiv(){
            let files = {
                id: this.expediente_id,
                download: true,
                nro_expediente: this.nro_expediente,
            }
            this.getArchivos(files)
        },
        close() {
            this.$emit("close")
        },
    }
}
</script>
<style>
.round {
    border-radius: 30px;
}

.descargar {
  font-size: 18px !important;
}
</style>
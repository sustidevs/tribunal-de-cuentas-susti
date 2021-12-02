<template>
  <v-dialog v-model="show" width="1200px" content-class="round">
    <v-card class="px-7 pt-1">
        <titulo texto="Expediente N° 800 - 28-04 - 1000/2021" icono="mdi-file-document"/>

        <v-row no-gutters align="start" class="pt-6">
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
            <v-col>
                <div class="d-flex">
                    <div class="textHereSmall Montserrat-Bold mr-3"> Archivos adjuntos: </div>
                    <v-chip @click="getArchiv()"> Descargar archivos</v-chip>
                </div>
            </v-col>
        </v-row>
        <v-row no-gutters align="start" class="mt-5">
            <div class="textHereSmall d-flex flex-column Montserrat-Bold mb-2"> Extracto: </div>
            <div class="textHereSmall d-flex flex-column Montserrat-SemiBold text-justify">RENDICIÓN DE CUENTAS N° 01/20 FDO.PTE.GTOS.BIENES DE CONSUMO
            SERVICIOS NO RESPONSABLE. BS. USO Y TRANF. DCTO M° 2548/20. $1.000.000.00 (MINISTERIO REPARTICIÓN).
            </div>
        </v-row>
        <v-row no-gutters align="start" class="mt-5">
            <div class="textHereSmall d-flex flex-column Montserrat-Bold mb-2"> A efectos de: </div>
            <div class="textHereSmall d-flex flex-column Montserrat-SemiBold text-justify"> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
        </v-row>

        <v-row no-gutters justify="center" class="mt-8">
            <v-col cols="12" sm="6" md="6" lg="6" class="py-6 px-sm-2">
                <v-btn @click="close" class="pa-5 color Montserrat-SemiBold" height="55" elevation="0" color="#FACD89" block>
                    <v-icon class="px-5"> mdi-check-bold </v-icon>
                    Aceptar
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
        datos: Number,
    },

    computed: mapGetters(['allExpedientes', 'get_archivos']),

    methods: {
        ...mapActions([ 'getExpedientes', 'getArchivos']),

        getArchiv(){
            let files = {
                id: this.datos,
                download: true
            }
            this.getArchivos(files)
        },

        close() {
            this.$emit("close")
            this.$router.go(0)
        },
    }
}
</script>
<style>
.round {
    border-radius: 30px;
}
</style>
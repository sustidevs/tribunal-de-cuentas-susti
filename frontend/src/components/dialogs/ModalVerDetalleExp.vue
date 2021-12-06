<template>
  <v-dialog v-model="show" width="1200px" content-class="round">
    <v-card class="px-7 pt-1">
        <titulo texto="Expediente N° 800 - 28-04 - 1000/2021" icono="mdi-file-document"/>

        <v-row no-gutters align="start" class="pt-6">
            <v-col>
                <div class="d-flex">
                    <div class="textHereSmall Montserrat-Bold mr-1"> Iniciador: </div>
                    <div class="textHereSmall Montserrat-SemiBold ml-1"> {{ this.datos.iniciador }} </div>
                </div>
            </v-col>
            <v-col>
                <div class="d-flex">
                    <div class="textHereSmall Montserrat-Bold mr-1"> Fecha de creación: </div>
                    <div class="textHereSmall Montserrat-SemiBold ml-1"> {{ this.datos.fecha_creacion }} </div>
                </div>
            </v-col>
        </v-row>


        <v-row no-gutters align="start" class="mt-5">
            <v-col>
                <div class="d-flex">
                    <div class="textHereSmall Montserrat-Bold mr-1"> Área emisora: </div>
                    <div class="textHereSmall Montserrat-SemiBold ml-1"> {{ this.datos.area_origen }} </div>
                </div>
            </v-col>
            <v-col>
                <div class="d-flex">
                    <div class="textHereSmall Montserrat-Bold mr-1"> Cuerpo: </div>
                    <div class="textHereSmall Montserrat-SemiBold ml-1"> {{ this.datos.cant_cuerpos }} </div>
                </div>
            </v-col>
        </v-row>
        <v-row no-gutters align="start" class="mt-5">
            <v-col>
                <div class="d-flex">
                    <div class="textHereSmall Montserrat-Bold mr-1"> Trámite: </div>
                    <div class="textHereSmall Montserrat-SemiBold ml-1"> {{ this.datos.tramite }} </div>
                </div>
            </v-col>
            <v-col>
                <div class="d-flex">
                    <div class="textHereSmall Montserrat-Bold mr-1"> Fojas: </div>
                    <div class="textHereSmall Montserrat-SemiBold ml-1"> {{ this.datos.fojas }} </div>
                </div>
            </v-col>
        </v-row>

        <v-row no-gutters align="start" class="mt-5">
            <v-col>
                <div class="d-flex">
                    <div class="textHereSmall Montserrat-Bold mr-2"> Archivos adjuntos: </div>
                    <div v-if="this.datos.archivo !== null">
                        <v-chip class="textHereSmall Montserrat-Regular" @click="getArchiv()"> Descargar</v-chip>
                    </div>
                    <div v-else class="textHereSmall d-flex flex-column Montserrat-SemiBold text-justify">
                        No se han cargado archivos
                    </div>
                </div>
            </v-col>
        </v-row>
        <v-row no-gutters align="start" class="mt-5">
            <div class="textHereSmall d-flex flex-column Montserrat-Bold mb-2 mr-2"> Extracto: </div>
            <div class="textHereSmall d-flex flex-column Montserrat-SemiBold text-justify"> {{ this.datos.extracto }} </div>
        </v-row>
        <v-row no-gutters align="start" class="mt-5">
            <div class="textHereSmall d-flex flex-column Montserrat-Bold mb-2 mr-2"> A efectos de: </div>
            <div class="textHereSmall d-flex flex-column Montserrat-SemiBold text-justify"> {{ this.datos.motivo[0].motivo }} </div>
        </v-row>

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
        datos: Object,
    },

    computed: mapGetters(['allExpedientes', 'get_archivos']),

    methods: {
        ...mapActions([ 'getExpedientes', 'getArchivos']),

        getArchiv(){
            let files = {
                id: this.datos.expediente_id,
                download: true,
                nro_expediente: this.datos.nro_expediente,
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
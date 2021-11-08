<template>
    <v-dialog v-model="show" width="1500" content-class="round">
      <v-card class="px-7 pt-1 pb-6">
        <v-row class="mt-5">
          <v-col cols="10">
            <h2 class="Montserrat-Bold text-justify">
              Consultar Expediente
            </h2>
          </v-col>
          <v-col cols="2" align="right">
            <v-btn  @click="close" icon elevation="0" color="grey lighten-2">
              <v-icon left large color="#393B44">
                mdi-close-thick
              </v-icon>
            </v-btn>
          </v-col>
        </v-row>
        <v-divider color="#393B44" class="mt-2"></v-divider>
        <form @submit.prevent="consultarExpediente(busqueda)" >

          <div class="Montserrat-Regular mt-4">
           Seleccione la opcion por la que desea buscar:
          </div>

          <v-btn-toggle class="py-12" v-model="busqueda.buscar_por" group  @change="showBuscar = true">

              <v-btn value="1" color="grey darken-1" class="px-8 pa-10 textRadio">
                <v-icon large color="rgb(251, 140, 0, 0.7)"> mdi-file-multiple </v-icon>
                N° de Expediente
              </v-btn>

            <v-btn value="3" color="grey darken-1" class="px-8 pa-10 textRadio">
              <v-icon large color="rgb(244, 67, 54, 0.7)"> mdi-cash </v-icon>
              N° de Cheque/Transferencia
            </v-btn>

            <v-btn value="2" color="grey darken-1" class="px-8 pa-10 textRadio">
              <v-icon large color="rgb(244, 67, 54, 0.7)"> mdi-account </v-icon>
              Cuit de Iniciador
            </v-btn>
          </v-btn-toggle>

        <div v-if="showBuscar">

          <text-field v-model="busqueda.valor"/>
            <v-row justify="center" class="pb-6">
              <v-btn type="submit" class="pa-5 color Montserrat-SemiBold" height="45" color="#FACD89">
                <v-icon class="pr-4"> mdi-text-box-search-outline </v-icon>
                Buscar
              </v-btn>
            </v-row>
          </div>

        </form>

        <div v-if="this.resultados">
          <expansion-panel/>
        </div>

       <!-- <div v-if="this.resultados">
          <v-row no-gutters class="text mt-4" justify="start">
            <v-col cols="12">
              <LabelInput texto="Resultados Obtenidos"/>
              <div v-if="this.resultados">
                <card-extracto-pase class="my-4" background="#FACD89" expediente="800 - 28-04 - 1000/2021" fecha="28-04-2021" responsable="Responsable" extracto="RENDICIÓN DE CUENTAS N° 01/20 FDO.PTE.GTOS.BIENES DE CONSUMO
                    SERVICIOS NO RESPONSABLE. BS. USO Y TRANF. DCTO M° 2548/20. $1.000.000.00 (MINISTERIO REPARTICIÓN)."></card-extracto-pase>
              </div>
              <div v-else>
                <div class="my-4">
                  <v-alert
                    dense
                    outlined
                    color="amber accent-4"
                  >
                    No se encontraron resultados
                  </v-alert>
                  </div>
              </div>
            </v-col>
          </v-row>
        </div>-->
      </v-card>
    </v-dialog>
</template>

<script>
import TextField from "../TextField";
import ExpansionPanel from "../ExpansionPanels"
import {mapActions} from "vuex";

export default {
  name: 'ModalConsultarNroExp',
  components: { TextField, ExpansionPanel},
  props: {
    show: Boolean,
  },
  
  data () {
    return {
      buscador: null,
      resultados: null,
      showBuscar: false,
      busqueda: {
        buscar_por: '',
        valor: '',
      },

      states: [
          { name: 'Con resultados'},
          { name: 'Sin resultados'},
        ],
    }
  },


  methods: {

    ...mapActions([
      'consultarExpediente',
    ]),

    close() {
      this.$emit("close")
    },

    mostrar () {
      this.showExtracto=!this.showExtracto;
    }

  },

}
</script>

<style>
.textRadio{
  font-family: Montserrat-Bold,serif;
  font-size: 22px !important;
}

</style>
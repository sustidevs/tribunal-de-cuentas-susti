<template>
    <v-dialog v-model="show" max-width="1200px" content-class="round">
      <v-card class="px-7 pt-1 pb-6">
        <v-row class="mt-5">
          <v-col cols="10">
            <h2 class="Montserrat-Bold text-justify">
              Consultar un expediente por
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
        <div class="d-flex justify-center column Montserrat-Semibold mt-4">

          <v-radio-group  row v-model="busqueda.buscar_por">
            <v-radio
                class="textRadio"
                color="orange"
                value="1"
                label="N° de expediente"
            >
            </v-radio>

            <v-radio
                value="2"
                class="textRadio"
                color="orange"
                label="Cuil del iniciador"
            >
            </v-radio>

            <v-radio
                value="3"
                class="textRadio"
                color="orange"
                label="Nro de transaccion"
            >
            </v-radio>

          </v-radio-group>

          <!--
          <v-btn-toggle v-model="busqueda.buscar_por" group class="justify-space-around">
              <v-btn value="1" x-large class="px-sm-12">
                  <v-icon color="amber accent-4" class="pr-2"> </v-icon>
                  N° de expediente
              </v-btn>
              <v-btn value="2" x-large class="px-sm-12">
                  <v-icon color="amber accent-4" class="pr-2">  </v-icon>
                  CUIL DEL INICIADOR
              </v-btn>
          </v-btn-toggle>-->
        </div>

        <div>
                  <div class="d-flex my-4">
                      <v-text-field
                          class="Montserrat-Regular text-justify"
                          color="amber accent-4"
                          outlined
                          v-model="busqueda.valor"
                          label="Por ejemplo: 27-41789321-8, ..."
                      ></v-text-field>
                  </div>
            <v-row justify="center" class="pb-6">
              <v-btn type="submit" class="pa-5 color Montserrat-SemiBold" height="45" color="#FACD89">
                <v-icon class="pr-4"> mdi-text-box-search-outline </v-icon>
                Buscar
              </v-btn>
            </v-row>
          </div>

        </form>

        <div v-if="this.resultados">
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
        </div>
      </v-card>
    </v-dialog>
</template>

<script>
import LabelInput from "../LabelInput"
import CardExtractoPase from '../CardExtractoPase.vue'
import {mapActions} from "vuex";

export default {
  name: 'ModalConsultarNroExp',
  components: {LabelInput, CardExtractoPase},
  props: {
    show: Boolean,
  },
  
  data () {
    return {
      buscador: null,
      resultados: null,

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
h2{
  font-size: 26px;
  color: #393B44;
}

.textRadio{
  font-family: Montserrat-Bold;
  font-size: 34px !important;
}

</style>
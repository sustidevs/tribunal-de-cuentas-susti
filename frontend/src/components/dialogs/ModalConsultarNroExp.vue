<template>
    <v-dialog v-model="show" width="1100" content-class="round">

      <div v-if="this.get_encontrado == false">
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

          <form @submit.prevent="consultar()" >
            <div class="Montserrat-SemiBold mt-4 py-2">
              Seleccione la opción por la que desea buscar:
            </div>

            <v-btn-toggle class="py-3" v-model="busqueda.buscar_por" group  @change="showBuscar = true">
              <v-btn value="1"  class="px-8 pa-8 textRadio">
                <v-icon class="pr-2" large color="rgb(251, 140, 0, 0.7)"> mdi-file-multiple </v-icon>
                N° de Expediente
              </v-btn>

              <v-btn value="3"  class="px-8 pa-8 textRadio">
                <v-icon class="pr-2" large color="rgb(244, 67, 54, 0.7)"> mdi-cash </v-icon>
                N° de Cheque/Transferencia
              </v-btn>

              <v-btn value="2"  class="px-8 pa-8 textRadio">
                <v-icon  class="pr-2" large color="rgb(244, 67, 54, 0.7)"> mdi-account </v-icon>
                CUIL del Iniciador
              </v-btn>
            </v-btn-toggle>

            <div v-if="showBuscar" class="pt-2">
              <div class="Montserrat-SemiBold mt-2 mb-1 py-2">
                Ingrese el valor:
              </div>
              <text-field v-model="busqueda.valor"/>
              <v-row justify="center" class="pb-6">
                <v-btn type="submit" class="pa-5 color Montserrat-SemiBold" height="45" color="#FACD89">
                  <v-icon class="pr-4"> mdi-text-box-search-outline </v-icon>
                  Buscar
                </v-btn>
              </v-row>
            </div>

          </form>
        </v-card>
      </div>


      <div v-if="this.get_encontrado">
         <v-card class="px-7 pt-1 pb-6">

           <v-row class="mt-5">
             <v-col cols="10">
               <h2 class="Montserrat-Bold text-justify">
                 Resultados Obtenidos
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

           <div v-if="this.get_busquedaExp.length == 0" class="Montserrat-Regular mt-4 py-2">
             No se han encontrado resultados

             <v-btn  @click="close" icon elevation="0" color="grey lighten-2">
               <v-icon left large color="#393B44">
                 mdi-close-thick
               </v-icon>
               Cerrar
             </v-btn>
           </div>


           <div v-if="this.get_busquedaExp.length > 0">
             <div class="Montserrat-Regular mt-4 py-2">
               Haga click en el resultado para mas detalles
             </div>

             <v-expansion-panels focusable>
               <v-expansion-panel class="my-2"  v-for="item in get_busquedaExp" :key="item.id">
                 <v-expansion-panel-header color="#FACD89" class="Montserrat-SemiBold sizeNroExp"> {{item.expediente_id }})   {{ item.nro_expediente}}</v-expansion-panel-header>

                 <v-expansion-panel-content>
                   <div class="Montserrat-Bold mt-4">Iniciador:</div>
                   <div class="Montserrat-Regular">{{item.iniciador }}</div>

                   <div class="Montserrat-Bold mt-4">Cuit:</div>
                   <div class="Montserrat-Regular">{{item.cuit }}</div>

                   <div class="Montserrat-Bold mt-4">Extracto:</div>
                   <div class="Montserrat-Regular">{{item.extracto }}</div>

                   <div class="Montserrat-Bold mt-4">Area Actual:</div>
                   <div class="Montserrat-Regular">{{item.area_actual }}</div>
                 </v-expansion-panel-content>
               </v-expansion-panel>
             </v-expansion-panels>
           </div>
         </v-card>
        </div>

    </v-dialog>
</template>

<script>
import TextField from "../TextField";
import {mapActions, mapGetters} from "vuex";

export default {
  name: 'ModalConsultarNroExp',
  components: { TextField},
  props: {
    show: Boolean,
  },
  
  data () {
    return {
      buscador: null,
      resultados: false,
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

  computed: mapGetters(['get_busquedaExp','get_encontrado']),

  methods: {

    ...mapActions([
      'consultarExpediente',
    ]),

    consultar () {
      this.consultarExpediente(this.busqueda)
    },

    close() {
      this.$emit("close")
      this.$router.go(0)
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
  font-size: 15px !important;
}

.sizeNroExp{
  font-size: 20px !important;
}

</style>
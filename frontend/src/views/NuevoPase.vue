<template>
  <div>
    <titulo texto="Nuevo Pase" icono="mdi-file-document" class="pb-8"/>
    <template>
      <form @submit.prevent="storePas()" >
        <v-stepper v-model="e1" class="mb-16">

          <v-card color="#facd89" class="Montserrat-Regular text-justify">
            <v-stepper-header>
              <v-stepper-step color="grey darken-3" :complete="e1 > 1" step="1">
                Datos Expediente
              </v-stepper-step>
              <v-divider></v-divider>
              <v-stepper-step color="grey darken-3" :complete="e1 > 2" step="2">
                Detalle del Pase
              </v-stepper-step>
            </v-stepper-header>
          </v-card>

          <!--Primer Step-->
          <v-stepper-items>
            <v-stepper-content step="1">
              <v-card elevation="0" class="mb-12">

                <label-input texto="Pase a:"/>

                <v-autocomplete
                    class="Montserrat-Regular text-justify"
                    color="amber accent-4"
                    outlined
                    item-value="idd"
                    single-line
                    return-object
                    item-color="amber accent-4"
                    :items="get_areas"
                    item-text="descripcion"
                    v-model="area"
                >
                </v-autocomplete>
                
                <label-input texto="A efectos de:"/>
                <text-field v-model="pase.motivo"/>

                <v-row>
                  <v-col cols="12" lg="4">
                    <label-input texto="Fecha y Hora del Pase:"/>
                    <v-text-field
                        class="Montserrat-Regular text-justify"
                        color="amber accent-4"
                        outlined
                        readonly
                        v-model="fecha"
                    ></v-text-field>
                  </v-col>

                  <v-col cols="12" lg="4">
                    <label-input texto="Agente que redacta el pase"/>
                    <text-field v-model="this.$store.getters.getNombreApellido"/>
                  </v-col>

                  <v-col cols="12" lg="4">
                    <label-input texto="Fojas"/>
                    <text-field v-model="pase.nro_fojas"/>
                  </v-col>
                </v-row>

                <label-input texto="Adjuntar Archivos"/>
                <file-inputs/>
              </v-card>

              <v-row justify="center" class="ma-8">
                <v-col cols="4">
                    <v-btn  class="pa-5 Montserrat-SemiBold" height="55" elevation="0" color="#FACD89" block @click="e1 = 2">
                      <div class="pr-5"> Continuar </div><v-icon>  mdi-arrow-right </v-icon>
                    </v-btn>
                </v-col>
              </v-row>
            </v-stepper-content>

            <v-stepper-content step="2">
              <modal-detalle-pase :data="this.pase" :dataArea="this.area"/>
              <v-row  justify="center" class="ma-8">
                <v-col cols="4">
                    <v-btn @click="e1 = 1" class="pa-5 Montserrat-SemiBold" height="55" elevation="0" block>
                      <v-icon class="pr-5"> mdi-arrow-left </v-icon> <div> Volver </div>
                    </v-btn>
                </v-col>
                <v-col cols="4">
                    <v-btn type="submit" class="pa-5 Montserrat-SemiBold" height="55" elevation="0" color="#FACD89" block>
                      <div class="pr-5"> Confirmar Pase </div><v-icon> mdi-check </v-icon>
                    </v-btn>
                </v-col>
              </v-row>
            </v-stepper-content>
          </v-stepper-items>
        </v-stepper>

        <modal-exito-pase :show="creado_exito" :dato="expediente_exito"/>
      </form>
    </template>
  </div>
</template>
<script>

import Titulo from "../components/Titulo";
import LabelInput from "../components/LabelInput";
import TextField from "../components/TextField";
import {mapActions, mapGetters} from "vuex";
import FileInputs from "../components/FileInputs";
import ModalDetallePase from "../components/dialogs/ModalDetallePase";
import ModalExitoPase from "../components/dialogs/ModalExitoPase";

export default {
    name: 'Nuevo Pase',
    components: {FileInputs, Titulo,LabelInput, TextField, ModalDetallePase,ModalExitoPase},
    data: () => ({
      files: [],
      e1: 1,
      area: [],
      pase:{
        motivo: '',
        nro_fojas: 0,
      }

    }),

  computed: {
    ... mapGetters(['creado_exito','expediente_exito','get_areas','fecha','getIdUser','expedientePase','idExpedientePase'])
  },

  methods: {
      ...mapActions([
          'storePase',
          'getNuevoPase'
      ]),

    storePas() {
      const pas = {
        user_id:  this.$store.getters.getIdUser,
        expediente_id: this.$store.getters.idExpedientePase,
        fojas: this.pase.nro_fojas,
        area_destino_id: this.area.id,
        area_destino_type: this.area.tipo_area,
        motivo: this.pase.motivo,
        archivos: null,
      }
      this.storePase(pas);
    },
  },

}
</script>
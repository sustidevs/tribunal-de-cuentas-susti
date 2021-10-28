<template>
        <v-card class="px-7 pt-1" outlined color="#F8E2C0">
            <v-row no-gutters align="center" >
                <v-col cols="12">
                    <div class="d-flex justify-start mt-4">
                        <div class="textHereSmall Montserrat-Bold mr-1"> Pase a:</div>
                       <!-- <div class="textHereSmall Montserrat-SemiBold"> {{ data.area.nombre }}</div> -->
                      <div class="textHereSmall Montserrat-SemiBold"> {{ dataArea.nombre }} </div>
                    </div>
                    <div class="d-flex justify-start mt-4">
                        <div class="textHereSmall Montserrat-Bold mr-1"> Fecha y hora: </div>
                        <div class="textHereSmall Montserrat-SemiBold"> {{ fecha }} </div>
                    </div>
                </v-col>
            </v-row>

          <v-row no-gutters>
            <div class="justify-start mt-4">
              <div class="d-flex column textHereSmall Montserrat-Bold mr-1"> A efectos de: </div>
              <div class="textHereSmall Montserrat-SemiBold text-justify"> {{ data.motivo}}</div>
            </div>
          </v-row>

          <v-row>
            <v-col cols="12" sm="12" lg="6">
              <div class="d-flex justify-start align-start mt-4">
                <div class="textHereSmall Montserrat-Bold mr-1"> Agente que redacta el pase:</div>
                <div class="textHereSmall Montserrat-SemiBold"> {{ this.$store.getters.getNombreApellido }}</div>
              </div>
            </v-col>
            <v-col cols="12" sm="12" lg="6">
              <div class="d-flex align-start mt-4">
                <div class="textHereSmall Montserrat-Bold mr-1"> Fojas: </div>
                <div class="textHereSmall Montserrat-SemiBold"> {{ data.nro_fojas }} </div>
              </div>
            </v-col>
          </v-row>


            <div class="justify-start align-start mt-4">
                <div class="d-flex column textHereSmall Montserrat-Bold"> Archivos adjuntados:</div>
                <div class="text-start justify-start">
                    <v-chip
                    class="ma-2"
                    close
                    color="#F5F5F5"
                    text-color="grey darken-3"
                    >
                        <v-avatar left>
                            <v-icon>mdi-checkbox-marked-circle</v-icon>
                        </v-avatar>
                        archivo.pdf
                    </v-chip>
                </div>
            </div>
        </v-card>
</template>
<script>
import {mapActions, mapGetters} from "vuex";

export default {
  name: 'ModalIniciador',
   components: { },
    props: {
      show: Boolean,
      data: Array,
      dataArea:Array,
    },

  methods: {
    ...mapActions([
      'getNuevoPase'
    ]),
  },

  computed: {
    ... mapGetters(['areas','fecha'])
  },

  mounted() {
    this.getNuevoPase();
  }
}
</script>
<style>
.round {
  border-radius: 30px;
}
</style>
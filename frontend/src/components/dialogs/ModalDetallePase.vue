<template>
  <v-row justify="center">
    <v-card rounded class="px-7 pt-1" width="800" height="auto " outlined color="#F8E2C0">

      <div class="py-8 Montserrat-Bold  tituloModal">
        Detalle del Pase
      </div>

      <v-row no-gutters align="center" >
        <div class="d-flex flex-column justify-start mt-4">
          <div class="textHereSmall Montserrat-SemiBold mr-1"> Pase a:</div>
          <!-- <div class="textHereSmall Montserrat-SemiBold"> {{ data.area.nombre }}</div> -->
          <div class="textHereSmall Montserrat-Bold"> {{ dataArea.nombre }} </div>
        </div>
      </v-row>

      <v-row no-gutters align="center" >
        <div class="d-flex flex-column justify-start mt-4">
          <div class="textHereSmall  Montserrat-SemiBold mr-1"> Fecha y hora: </div>
          <div class="textHereSmall Montserrat-Bold"> {{ fecha }} </div>
        </div>
      </v-row>


      <v-row no-gutters>
        <div class="justify-start mt-4">
          <div class="d-flex column textHereSmall Montserrat-SemiBold mr-1"> A efectos de: </div>
          <div class="textHereSmall Montserrat-Bold text-justify"> {{ data.motivo}}</div>
        </div>
      </v-row>

      <v-row no-gutters>
        <div class="d-flex justify-start flex-column align-start mt-4">
          <div class="textHereSmall  Montserrat-SemiBold mr-1"> Agente que redacta el pase:</div>
          <div class="textHereSmall Montserrat-Bold"> {{ this.$store.getters.getNombreApellido }}</div>
        </div>
      </v-row>


      <v-col cols="12" sm="12" lg="12">
        <div class="d-flex align-start flex-column mt-4">
          <div class="textHereSmall  Montserrat-SemiBold mr-1"> Fojas: </div>
          <div class="textHereSmall Montserrat-Bold"> {{ data.nro_fojas }} </div>
        </div>
      </v-col>
    </v-card>
  </v-row>
          <!--
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
            -->

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

.textHereSmall{
  font-size: 25px;
}
.round {
  border-radius: 30px;
}
</style>
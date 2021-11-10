<template>
  <v-row justify="center">
    <v-card elevation="0" class="mb-5 py-8 px-5" width="1700" color="grey lighten-4">
      <div class="fontBig Montserrat-SemiBold pt">
        DETALLE DEL PASE
      </div>
      <v-divider class="my-3"/>

      <v-row no-gutters class="pt-3">
        <v-col cols="12" lg="6">
          <div class="d-flex justify-start">
            <div class="fontSmall Montserrat-SemiBold mr-3"> Pase a:</div>
            <div class="fontBig Montserrat-Regular"> {{ dataArea.descripcion }} </div>
          </div>
        </v-col>
        <v-col cols="12" lg="6">
          <div class="d-flex justify-start">
            <div class="fontSmall Montserrat-SemiBold mr-3"> Fecha y hora: </div>
            <div class="fontBig Montserrat-Regular"> {{ fecha[0]}}, {{ fecha[1] }}h. </div>
          </div>
        </v-col>
      </v-row>

      <v-row no-gutters class="pt-5">
        <v-col cols="12" lg="6">
          <div class="d-flex justify-start">
            <div class="fontSmall Montserrat-SemiBold mr-3"> Agente que redacta el pase:</div>
            <div class="fontBig Montserrat-Regular"> {{ this.$store.getters.getNombreApellido }}</div>
          </div>
        </v-col>
        <v-col cols="12" lg="6">
          <div class="d-flex">
            <div class="fontSmall Montserrat-SemiBold mr-3"> Fojas: </div>
            <div class="fontBig Montserrat-Regular"> {{ data.nro_fojas }} </div>
          </div>
        </v-col>
      </v-row>

      <v-row no-gutters class="py-5">
        <v-col cols="12" sm="12" lg="12">
          <div class="d-flex justify-start">
            <div class="fontSmall Montserrat-SemiBold mr-3"> A efectos de: </div>
            <div class="fontBig Montserrat-Regular text-justify"> {{ data.motivo}} </div>
          </div>
        </v-col>
      </v-row>
    </v-card>
  </v-row>

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
.detalle{
    font-size: 25px;
    color: #FACD89;
}

.fontBig{
    font-size: 25px;
    color: #393B44;
}

.fontSmall{
    font-size: 24px;
    color: #393B44;
}
</style>
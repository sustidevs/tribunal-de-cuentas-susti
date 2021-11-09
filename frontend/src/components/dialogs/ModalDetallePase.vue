<template>
  <v-row justify="center">
    <v-card elevation="0" class="mb-12" width="1700">
      <div class="textHereBig py-8 Montserrat-Bold">
        Detalle del Pase
      </div>

      <v-row no-gutters align="center" >
        <div class="d-flex flex-column justify-start mt-4">
          <div class="fontBig Montserrat-SemiBold mr-1"> Pase a:</div>
          <div class="fontSmall Montserrat-Bold"> {{ dataArea.nombre }} </div>
        </div>
      </v-row>

      <v-row no-gutters align="center" >
        <div class="d-flex flex-column justify-start mt-4">
          <div class="fontBig Montserrat-SemiBold mr-1"> Fecha y hora: </div>
          <div class="fontSmall Montserrat-Bold"> {{ fecha }} </div>
        </div>
      </v-row>


      <v-row no-gutters>
        <div class="justify-start mt-4">
          <div class="d-flex column fontBig Montserrat-SemiBold mr-1"> A efectos de: </div>
          <div class="fontSmall Montserrat-Bold text-justify"> {{ data.motivo}}</div>
        </div>
      </v-row>

      <v-row no-gutters>
        <div class="d-flex justify-start flex-column align-start mt-4">
          <div class="fontBig Montserrat-SemiBold mr-1"> Agente que redacta el pase:</div>
          <div class="fontSmall Montserrat-Bold"> {{ this.$store.getters.getNombreApellido }}</div>
        </div>
      </v-row>

      <v-row no-gutters>
        <v-col cols="12" sm="12" lg="12">
          <div class="d-flex align-start mt-4">
            <div class="fontBig Montserrat-SemiBold mr-3"> Fojas: </div>
            <div class="fontSmall Montserrat-Bold mt-1"> {{ data.nro_fojas }} </div>
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
.fontBig{
    font-size: 25px;
    color: #393B44;
}

.fontSmall{
    font-size: 22px;
    color: #393B44;
}

.sizeI{
  font-size: 22px !important;
  color: #393B44;
}
</style>
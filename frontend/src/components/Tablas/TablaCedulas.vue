<template>
  <div>
    <v-row>
      <v-col cols="12" sm="4">
        <v-text-field
          color="#8D93AB"
          v-model="search"
          append-icon="mdi-magnify"
          label="Buscar"
          hide-details
          outlined
          class="py-6"
        />
      </v-col>
    </v-row>

    <v-data-table
      :headers="headers"
      :items="data"
      :search="search"
      :items-per-page="5"
      disable-sort
      mobile-breakpoint="300"
      class="elevation-1 mytable"
      loading-text="Cargando expedientes. Por favor, espere."
      :loading="loading"
      no-data-text="No tienes Expedientes"
    >
      <template v-slot:item.prioridad="{ item }">
        <v-chip :color="getColor(item.prioridad)">
          <v-icon size="20px" class="mr-1">{{
            getIcon(item.prioridad)
          }}</v-icon>
          <h5 class="font-weight-regular">{{ item.prioridad }}</h5>
        </v-chip>
      </template>

      <template v-slot:item.action1="{ item }">
        <v-btn @click="verDetalleCedula(item)" fab small color="#FACD89" depressed>
          <v-icon> mdi-card-account-details </v-icon>
        </v-btn>
      </template>

      <template v-slot:item.action="{ item }">
        <v-btn @click="AbrirModalCedula(item)" fab small color="#FACD89" depressed>
          <v-icon> mdi-credit-card-plus </v-icon>
        </v-btn>
      </template>
    </v-data-table>
    <modal-nueva-cedula :show="show_modal" :datos="this.datos"/>
    <modal-detalle-cedula :show="show_detalle" :datos="get_detalle"/>
  </div>
</template>

<script>
import ModalNuevaCedula from "../../components/dialogs/ModalNuevaCedula";
import ModalDetalleCedula from "../dialogs/ModalDetalleCedula";
import {mapActions, mapGetters} from "vuex";

export default {
  components: { ModalNuevaCedula, ModalDetalleCedula},
  props: {
    headers: Array,
    data: Array,
    loading: { type: Boolean, default: false },
  },

  data() {
    return {
      show_modal: false,
      show_detalle: false,
      selected: [],
      search: "",
      datos:{
        id: '',
        nro_expediente: '',
        extracto: '',
      },
    };
  },

  computed: {
    ... mapGetters(['get_detalle'])
  },

  methods: {
    ...mapActions([
      'verDetalle'
    ]),

    getColor(prioridades) {
      if (prioridades === "alta") return "red lighten-3";
      if (prioridades === "normal") return "grey lighten-2";
    },

    getIcon(prioridades) {
      if (prioridades === "alta") return "mdi-exclamation-thick";
      else return "mdi-check-bold";
    },


    AbrirModalCedula(item) {
      this.datos.id = item.expediente_id,
      this.datos.nro_expediente = item.nro_expediente,
      this.datos.extracto = item.extracto,
      this.show_modal = true;
    },

    verDetalleCedula(item){
      let exp = {
        expediente_id: item.expediente_id,
      }
      this.show_detalle = true;
      this.verDetalle (exp)
    },
  },
};
</script>

<style>
.v-data-table > .v-data-table__wrapper > table > thead > tr > th > span {
  font-size: 19px !important;
}

.mytable thead {
  background-color: #facd89 !important;
  font-family: "Montserrat-Regular", serif !important;
}

.v-data-table > .v-data-table__wrapper > table > tbody > tr > td {
  font-family: "Montserrat-Regular", serif !important;
  font-size: 17px !important;
  padding: 12px !important;
}

.v-data-table > .v-data-table__wrapper > table > tbody > tr:hover {
  background-color: #fae3bf !important;
}
</style>

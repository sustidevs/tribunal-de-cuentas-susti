<template>
  <div>
    <v-row>
      <v-col
          cols="12"
          sm="4"
      >
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
          :items="items"
          :search="search"
          :items-per-page="5"
          disable-sort
          mobile-breakpoint="300"
          class="elevation-1 mytable"
          v-model="selected"
          loading-text="Cargando expedientes. Por favor, espere."
          :loading="loading"
          no-data-text="No hay Expedientes Pendientes por aceptar"
      >

        <template v-slot:item.prioridad="{ item }">
          <v-chip
              :color="getColor(item.prioridad)"
          >
            <v-icon size="20px" class="mr-1">{{getIcon(item.prioridad)}}</v-icon><h5 class="font-weight-regular">{{ item.prioridad }}</h5>
          </v-chip>
        </template>

        <template v-slot:item.action1= "{item}">
          <v-btn @click="detalle(item)" fab small color="#FACD89" depressed>
            <v-icon> mdi-eye </v-icon>
          </v-btn>
        </template>

        <template v-slot:item.action= "{item}">
          <v-btn @click="recibirI(item)" fab small color="#FACD89" depressed>
            <v-icon> mdi-text-box-check </v-icon>
          </v-btn>
        </template>
      </v-data-table>

      <modal-ver-detalle-exp
            :datos="datos"
            :show="show_modal"
            @close="closeModal"
      />
  </div>
</template>

<script>
import {mapActions} from "vuex";
import ModalVerDetalleExp from "../../components/dialogs/ModalVerDetalleExp";


export default {
  components: { ModalVerDetalleExp },
  props: {
    items: Array,
    data: Array,
    loading: {type: Boolean, default: false},
  },

  data () {
    return {
      selected:[],
      headers: [
        {text: 'Prioridad', value: 'prioridad'},
        {text: 'Nro. de Expediente', value: 'nro_expediente'},
        {text: 'Extracto', value: 'extracto', width: "33%"},
        {text: 'Área Origen', value:'area_origen'},
        {text: 'Trámite', value: 'tramite', width: "5%"},
        {text: 'Fecha Creación', value: 'fecha_creacion', width: "5%"},
        {text: 'Cuerpo', value: 'cant_cuerpos', align: 'center'},
        {text: 'Fojas', value: 'fojas', align: 'center'},
        {text: 'Ver detalle', value: 'action1', align: 'center', sortable: false},
        {text: 'Aceptar', value: 'action', align: 'center', sortable: false},
      ],
      search: '',
      show_modal: false,
      expediente_id:0,
    }
  },

  methods: {

    ...mapActions([
      'recibir'
    ]),

    getColor (prioridades) {
      if (prioridades === 'alta') return 'red lighten-3'
      if (prioridades === 'normal') return 'grey lighten-2'
    },
    getIcon (prioridades) {
      if (prioridades === 'alta') return 'mdi-exclamation-thick'
      else return 'mdi-check-bold'
    },
    openExpediente (item) {
      this.editedIndex = this.data.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialogExpediente = true
    },
    recibirI (item) {
          item.estado_expediente = 3
          item.estado= 1,
          item.bandeja= 1,
          item.user_id= this.$store.getters.getIdUser,
          this.recibir(item)
    },
    
    detalle(item) {
      this.show_modal = true;
      this.datos = item
      this.show_modal = true;
    },

    closeModal() {
      this.show_modal = false;
    }
  },
}
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
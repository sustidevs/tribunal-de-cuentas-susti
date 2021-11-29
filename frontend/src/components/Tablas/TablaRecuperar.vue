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

    <a>
      <v-data-table
          :headers="headers"
          :items="items"
          :search="search"
          :items-per-page="5"
          disable-sort
          mobile-breakpoint="300"
          class="elevation-1 mytable"
          v-model="selected"
          @click:row="recuperar"
          no-data-text="No hay Expedientes para recuperar"
      >

        <template v-slot:item.prioridad="{ item }">
          <v-chip
              :color="getColor(item.prioridad)"
          >
            <v-icon size="20px" class="mr-1">{{getIcon(item.prioridad)}}</v-icon><h5 class="font-weight-regular">{{ item.prioridad }}</h5>
          </v-chip>
        </template>

        <template v-slot:item.action="{ }">
          <v-btn fab small color="#FACD89" depressed>
            <v-icon> mdi-arrow-u-left-bottom-bold </v-icon>
          </v-btn>
        </template>
      </v-data-table>
    </a>

  </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
  props: {
    items: Array,
  },

  data () {
    return {
      selected:[],
      headers: [
        {text: 'Prioridad', value: 'prioridad'},
        {text: 'Nro. de Expediente', value: 'nro_expediente'},
        {text: 'Extracto', value: 'extracto'},
        {text: 'Fecha Creación', value: 'fecha_creacion'},
        {text: 'Trámite', value: 'tramite'},
        {text: 'Cuerpo', value: 'cant_cuerpos'},
        {text: 'Fojas', value: 'fojas'},
        {text: 'Recuperar', value: 'action', align: 'center', sortable: false},
      ],
      search: '',
    }
  },

  methods: {

    ...mapActions([
      'recibir'
    ]),

    getColor (prioridades) {
      if (prioridades === 'alta') return 'red lighten-3'
      if (prioridades === 'media') return 'grey lighten-2'
    },
    getIcon (prioridades) {
      if (prioridades === 'alta') return 'mdi-exclamation-thick'
      else return 'mdi-check-bold'
    },
    recuperar (item) {
      item.estado_expediente = 4
      item.estado= 1,
          item.bandeja= 1,
          item.user_id= this.$store.getters.getIdUser,
          this.recibir(item)
    }
  },
}
</script>

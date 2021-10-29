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
          <v-chip
              :color="getColor(item.prioridad)"
              :class="getClass(item.prioridad)"
          >
            <v-icon size="20px" class="mr-1">{{getIcon(item.prioridad)}}</v-icon><h5 class="font-weight-regular">{{ item.prioridad }}</h5>
          </v-chip>
        </template>

      </v-data-table>
    </a>

  </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
  props: {
    headers: Array,
    data: Array,
    loading: {type: Boolean, default: false},
  },

  data () {
    return {
      selected:[],
      search: '',
    }
  },

  methods: {
    getColor (prioridades) {
      if (prioridades === 'alta') return 'red lighten-3'
      if (prioridades === 'media') return 'yellow lighten-3'
      if (prioridades === 'baja') return 'green lighten-3'
    },
    getClass (prioridades) {
      if (prioridades === 'Alta') return 'white--text'
      else return 'grey--text text--darken-3'
    },
    getIcon (prioridades) {
      if (prioridades === 'Alta') return 'mdi-exclamation-thick'
      else return 'mdi-check-bold'
    },

    ...mapActions([
      'getNuevoPase'
    ]),
  }
}
</script>

<style>
.v-data-table > .v-data-table__wrapper > table > thead > tr > th > span {
  font-size: 19px !important;
}

.mytable thead {
  background-color: #facd89 !important;
  font-family: "Montserrat-Regular",serif !important;
}

.v-data-table > .v-data-table__wrapper > table > tbody > tr > td {
  font-family: "Montserrat-Regular",serif !important;
  font-size: 17px !important;
}

.v-data-table > .v-data-table__wrapper > table > tbody > tr:hover{
  background-color: #FAE3BF !important;
}

</style>
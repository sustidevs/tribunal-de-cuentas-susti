<template>
  <div class="pb-12">
    <v-row>
      <v-col cols="12" lg="4">
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
    <v-row>
      <v-col cols="12" lg="7">
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
            no-data-text="No tienes expedientes"
        >
          <template v-slot:item.action="{ item }">
            <v-btn @click="verHijos(item)" fab small color="#FACD89" depressed>
              <v-icon>mdi-arrow-right-thick</v-icon>
            </v-btn>
          </template>
        </v-data-table>
      </v-col>

      <v-col cols="12" lg="5">
        <v-toolbar
            color="#facd89"
            dark
            class="Montserrat-SemiBold text--darken-3 grey--text"
        >
          Expedientes seleccionados
        </v-toolbar>
        <v-card class="mx-auto" tile>
          <v-list>
            <v-list-item-title class="contentSize Montserrat-SemiBold">
              <v-icon>mdi-file</v-icon> Expediente Principal: <strong>{{ getExpedientePadre.nro_expediente }}</strong>
            </v-list-item-title>

            <v-divider color="#393B44" class="mt-2 my-4"></v-divider>

            <v-list-item-title class="contentSize Montserrat-SemiBold">
              <v-icon>mdi-file</v-icon> Expedientes englosados / hijos
            </v-list-item-title>

            <v-list-item v-for="item in getExpedientesHijos" :key="item.id">
              <v-list-item-content>
                <v-list-item-title class="contentSize Montserrat-SemiBold" v-text="item.nro_expediente"></v-list-item-title>
                <v-list-item-content class="contentSize Montserrat-Regular" v-text="item.extracto"/>
                <v-divider class="my-2"></v-divider>
              </v-list-item-content>
            </v-list-item>

          </v-list>

          <div class="contentSize Montserrat-Regular pa-4">
            <v-row justify="center" align="center">
              <v-btn @click="confirmarEnglose" class="pa-1 color Montserrat-SemiBold px-9" height="55" elevation="0" color="#FACD89">
                <v-icon class="px-2">
                  mdi-check-bold
                </v-icon>
                <div class="">
                  Desglosar
                </div>
              </v-btn>
            </v-row>
          </div>
        </v-card>


      </v-col>
    </v-row>
  </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
  props: {
    headers: Array,
    data: Array,
    loading: {type: Boolean, default: false},
  },

  data() {
    return {
      seleccionados: [],
      search: "",
    };
  },

  computed: mapGetters(['getExpedientesHijos','getExpedientePadre']),

  methods: {
    ...mapActions([
      "desglosarVer",
        ''
    ]),

    confirmarEnglose(){
      let expediente_hijo = [];

      for (var i = 1; i < this.seleccionados.length; i++) {
        expediente_hijo.push(this.seleccionados[i].expediente_id);
      }

      let expedientes_englose = {
        user_id: this.$store.getters.getIdUser,
        exp_padre: this.seleccionados[0].expediente_id,
        exp_hijos: expediente_hijo
      }
      this.englosar(expedientes_englose)
    },

    quitar (item){
      this.seleccionados.splice(item)
    },

    verHijos: function (item) {
      let expedientePase = {
        id : item.expediente_id
      }
      this.desglosarVer(expedientePase)
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
}

.v-data-table > .v-data-table__wrapper > table > tbody > tr:hover {
  background-color: #fae3bf !important;
}

.subSize{
  font-size: 22px ;
}

.contentSize{
  font-size: 18px;
}
</style>

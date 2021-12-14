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
    <v-row class="mb-16">
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
            <v-btn @click="seleccionar(item)" fab small color="#FACD89" depressed>
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
            <div v-if="seleccionados.length === 0" class="contentSize Montserrat-Regular pa-4">
              Aún no ha seleccionado ningún expediente para englosar
            </div>

            <v-list-item v-for="item in seleccionados" :key="item.id">
              <v-list-item-icon>
                <v-icon>mdi-file</v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title class="contentSize Montserrat-SemiBold" v-text="item.nro_expediente"></v-list-item-title>
                <v-list-item-content class="contentSize Montserrat-Regular" v-text="item.extracto"/>
                <v-row @click="quitar(item)"  no-gutters>
                  <v-icon class="red--text">mdi-close</v-icon><div class="pt-1 Montserrat-Regular red--text">Quitar Selección</div>
                </v-row>
                <v-divider class="my-2"></v-divider>
              </v-list-item-content>
            </v-list-item>
          </v-list>

          <div v-if="!(seleccionados.length === 0)" class="contentSize Montserrat-Regular pa-6">
            <v-row justify="center" align="center">
              <v-btn @click="confirmarEnglose" class="pa-1 color Montserrat-SemiBold px-9" height="55" elevation="0" color="#FACD89">
                <v-icon class="px-2">
                  mdi-check-bold
                </v-icon>
                <div class="">
                  Confirmar
                </div>
              </v-btn>
            </v-row>
          </div>
        </v-card>
      </v-col>
    </v-row>
    <modal-exito-englose :show="show"/>
  </div>
</template>

<script>
import {mapActions} from "vuex";
import ModalExitoEnglose from '../../components/dialogs/ModalExitoEnglose';

export default {
  components:{ModalExitoEnglose},
  props: {
    headers: Array,
    data: Array,
    loading: {type: Boolean, default: false},
  },

  data() {
    return {
      seleccionados: [],
      search: "",
      show: false,
    };
  },

  methods: {
    ...mapActions([
      "englosar"
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

      this.show = true;
    },

    quitar (item){
      this.seleccionados.splice(item)
    },

    seleccionar: function (item) {
      this.seleccionados.push(item)
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

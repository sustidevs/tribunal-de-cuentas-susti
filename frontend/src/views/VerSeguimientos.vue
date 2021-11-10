<template>
    <div>
      <titulo class="pb-3" texto="Historial del Expediente N°" :nro="this.get_historial_nro" icono="mdi-text-box-search-outline"/>
      <v-row>
        <v-btn @click="refColores=!refColores" color="grey lighten-2" class="mt-4 ml-3"> Referencia de colores
          <v-icon right>
            mdi-chevron-right
          </v-icon>
        </v-btn>

        <div class="text-center mt-3 pl-3" v-show="refColores">
          <v-chip
            class="ma-2"
            color="blue-grey darken-1"
            label
            text-color="white"
          >
            Departamento de Administración
          </v-chip>
        </div>
      </v-row>

      <v-row class="pb-6" justify="center">
        <v-timeline
            align-top
            :dense="$vuetify.breakpoint.smAndDown"
        >
            <v-timeline-item
              v-for="item in this.get_Historial"
              :key="item.id"
              :color="item.color"
              :icon="item.icon"
              :area="item.area"
              :asignado="item.asignado"
              :fecha="item.fecha"
              fill-dot
            >
              <v-card
                  :color="item.color"
              >
                  <div class="pl-4 pt-4 pb-3">
                      <div class="area pb-2"> {{item.area}} </div>
                      <v-row class="titulo black--text">
                          <v-col cols="12" lg="8" md="12">
                              <div class="pt-2">Asignado a: {{item.nombre_usuario}}</div>
                          </v-col>
                          <v-col cols="12" lg="4" md="12">
                              <div class="pt-2">Fecha: {{item.fecha}} </div>
                          </v-col>
                      </v-row>
                  </div>

                <v-card-text class="white text--primary">
                  <div class="Montserrat-Bold pb-2"> Area Origen: </div>
                  <p>{{item.area_origen}}</p>
                  <div class="Montserrat-Bold pb-2"> Derivado al Area: </div>
                  <p>{{item.area_destino}}</p>
                  <div class="Montserrat-Bold pb-2"> Motivo: </div>
                  <p>{{item.motivo}}</p>
                </v-card-text>

                <v-card-text class="white text--primary">
                      <div class="Montserrat-Bold pb-2"> Observaciones </div>
                      <p>Lorem ipsum dolor sit amet, no nam oblique veritus. Commune scaevola imperdiet nec ut, sed euismod convenire principes at. Est et nobis iisque percipit, an vim zril disputando voluptatibus, vix an salutandi sententiae.</p>
                  </v-card-text>

              </v-card>
            </v-timeline-item>
        </v-timeline>
      </v-row>
    </div>
</template>
<script>
import Titulo from "../components/Titulo"
import {mapActions, mapGetters} from "vuex";

export default {
  name: 'VerSeguimientos',
  components: {Titulo},


  data () {
    return {
      refColores: false,
    }
    },

  computed: mapGetters(['get_Historial','get_historial_nro']),

  mounted() {
    this.todos_exp();
  },

  methods: {
    ...mapActions(['cerrar', 'todos_exp']),
  }

  }
</script>

<style>
.titulo {
  font-family: Montserrat-Bold;
  font-size: 18px;
}

.area {
  font-family: Montserrat-Regular;
  font-size: 16px;
}
</style>
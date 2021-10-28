<template>
    <div>
      <titulo class="pb-3" texto="Historial del Expediente N° 800-28-04-1000/2021" icono="mdi-text-box-search-outline"/>
      <v-row>
        <v-btn @click="refColores=!refColores" color="grey lighten-2" class="mt-4 ml-3"> Referencia de colores
          <v-icon right>
            mdi-chevron-right
          </v-icon>
        </v-btn>
        <div class="text-center mt-3 pl-3" v-show="refColores">
          <v-chip
            class="ma-2"
            label
            color="orange lighten-1"
            text-color="white"
          >
            Mesa de Entrada
          </v-chip>

          <v-chip
            class="ma-2"
            color="red lighten-1"
            label
            text-color="white"
          >
            Auditoría
          </v-chip>

          <v-chip
            class="ma-2"
            color="teal lighten-1"
            label
            text-color="white"
          >
            Registraciones
          </v-chip>

          <v-chip
            class="ma-2"
            color="cyan lighten-1"
            label
            text-color="white"
          >
            Informática
          </v-chip>

          <v-chip
            class="ma-2"
            color="blue lighten-1"
            label
            text-color="white"
          >
            Notificaciones
          </v-chip>
          
          <v-chip
            class="ma-2"
            color="indigo lighten-1"
            label
            text-color="white"
          >
            Contaduría
          </v-chip>

          <v-chip
            class="ma-2"
            color="green lighten-1"
            label
            text-color="white"
          >
            Secretaría Técnica
          </v-chip>

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
              v-for="(item, i) in items"
              :key="i"
              :color="item.color"
              :icon="item.icon"
              :area="item.area"
              :asignado="item.asignado"
              :fecha="item.fecha"
              fill-dot
            >
              <v-card
                  :color="item.color"
                  dark
              >
                  <div class="pl-4 pt-4 pb-3">
                      <div class="area pb-2"> {{item.area}} </div>
                      <v-row class="titulo white--text">
                          <v-col cols="12" lg="8" md="12">
                              <div class="pt-2">Asignado a: {{item.asignado}}</div>
                          </v-col>
                          <v-col cols="12" lg="4" md="12">
                              <div class="pt-2">Fecha: {{item.fecha}} </div>
                          </v-col>
                      </v-row>
                  </div>
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

export default {
  name: 'VerSeguimientos',
  components: {Titulo},
  
  data () {
    return {
      refColores: false,
      items: [
        {
          color: 'orange lighten-1',
          icon: 'mdi-text-box-check-outline',
          area: 'Mesa de Entrada',
          asignado: 'Anabella123',
          fecha: '08/09/2021',
        },
        {
          color: 'red lighten-1',
          icon: 'mdi-text-box-check-outline',
          area: 'Auditoría',
          asignado: 'Martín20',
          fecha: '15/09/2021',
        },
        {
          color: 'indigo lighten-1',
          icon: 'mdi-text-box-check-outline',
          area: 'Contaduría',
          asignado: 'Agustina780',
          fecha: '28/09/2021',
        },
        {
          color: 'orange lighten-1',
          icon: 'mdi-text-box-check-outline',
          area: 'Mesa de Entrada',
          asignado: 'Cesar84',
          fecha: '01/10/2021',
        },
        {
          color: 'teal lighten-1',
          icon: 'mdi-text-box-check-outline',
          area: 'Registraciones',
          asignado: 'Esteban520',
          fecha: '07/10/2021',
        },
        {
          color: 'cyan lighten-1',
          icon: 'mdi-text-box-check-outline',
          area: 'Informática',
          asignado: 'Aldana87',
          fecha: '10/10/2021',
        },
        {
          color: 'blue lighten-1',
          icon: 'mdi-text-box-check-outline',
          area: 'Notificaciones',
          asignado: 'Matías120',
          fecha: '12/10/2021',
        },
        {
          color: 'orange lighten-1',
          icon: 'mdi-text-box-check-outline',
          area: 'Mesa de entrada',
          asignado: 'Martín20',
          fecha: '15/10/2021',
        },
      ],
    }
    },
  
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
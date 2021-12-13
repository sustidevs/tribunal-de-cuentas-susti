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
      loading-text="Cargando lista de iniciadores. Por favor, espere."
      :loading="loading"
      no-data-text="No hay iniciadores cargados en el sistema"
    >
      <template v-slot:item.action="{ item }">
          <v-btn @click="enviarId(item)" fab small color="#FACD89" depressed>
            <v-icon>mdi-pencil</v-icon>
          </v-btn>
      </template>
    </v-data-table>
  </div>
</template>

<script>
import {mapActions} from "vuex";
export default {
    components: {},
    props: {
    data: Array,
    loading: { type: Boolean, default: false },
    },

    data () {
        return {
            search: "",
            headers: [
                { text: 'Nombre', value: 'nombre' },
                { text: 'CUIL', value: 'cuil' },
                { text: 'CUIT', value: 'cuit' },
                { text: 'Correo', value: 'email' },
                { text: 'Teléfono', value: 'telefono' },
                { text: 'Dirección', value: 'direccion' },
                {text: 'Editar', value: 'action', align: 'center', sortable: false},
            ],
        }
    },

    methods: {
      ...mapActions([ 'getIniciador']),

        enviarId(item) {
          let idiniciador = {
            id: item.id
          }

        this.getIniciador(idiniciador)
         // this.$router.push({ name: "EditarIniciador" });
        },
    },
}
</script>
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
      :items="items"
      :search="search"
      :items-per-page="5"
      disable-sort
      mobile-breakpoint="300"
      class="elevation-1 mytable"
      loading-text="Cargando lista de iniciadores. Por favor, espere."
      :loading="loading"
      no-data-text="No hay iniciadores cargados en el sistema"
    >
      <template v-slot:item.action="{}">
          <v-btn fab small color="#FACD89" depressed>
            <v-icon>mdi-pencil</v-icon>
          </v-btn>
      </template>
    </v-data-table>
  </div>
</template>

<script>
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
                { text: 'Nombre', value: 'name' },
                { text: 'Tipo', value: 'tipo' },
                { text: 'CUIL', value: 'cuil' },
                { text: 'CUIT', value: 'cuit' },
                { text: 'Correo', value: 'correo' },
                { text: 'Teléfono', value: 'telefono' },
                { text: 'Dirección', value: 'direccion' },
                {text: 'Editar', value: 'action', align: 'center', sortable: false},
            ],
            items: [
                {name: 'Ministerio de Seguridad', tipo: 'Ministerios y Reparticiones', cuil: '', cuit: '123456789', correo: 'prueba@gmail.com', telefono: '379465689', direccion: 'Perú 1400'},
                {name: 'María Anabella', tipo: 'Persona Física', cuil: '27352223331', cuit: '', correo: 'prueba2@gmail.com', telefono: '3794124578', direccion: 'Madrid 1750'},
            ],
        }
    },
}
</script>
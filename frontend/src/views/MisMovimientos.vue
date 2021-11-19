<template>
    <div>
        <titulo texto="Mis Movimientos" icono="mdi-text-box-multiple" />
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
                    class="py-6 text_regular"
                />
            </v-col>
        </v-row>
        <tabla-mis-movimientos/>
    </div>
</template>
<script>
import Titulo from "../components/Titulo"
import TablaMisMovimientos from '../components/Tablas/TablaMisMovimientos.vue'

export default {
  name: 'MisMovimientos',
  components: {Titulo, TablaMisMovimientos},

}
</script>
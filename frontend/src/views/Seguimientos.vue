<template>
    <div>
        <titulo texto="Historiales" icono="mdi-text-box-search-outline" />
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
        <tabla-seguimientos class="mt-2"/>
    </div>
</template>
<script>
import Titulo from "../components/Titulo"
import TablaSeguimientos from '../components/Tablas/TablaSeguimientos.vue';

export default {
  name: 'Historial',
  components: {TablaSeguimientos, Titulo},
  }
</script>
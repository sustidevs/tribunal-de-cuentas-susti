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
        <tabla-seguimientos :datos="datos" class="mt-2"/>
    </div>
</template>
<script>
import Titulo from "../components/Titulo"
import TablaSeguimientos from '../components/Tablas/TablaSeguimientos.vue';

export default {
  name: 'Historial',
  components: {TablaSeguimientos, Titulo},

  headers: [
    {text: 'Nro. de Expediente', value: 'nro_expediente'},
    {text: 'Extracto', value: 'extracto'},
    {text: 'Trámite', value: 'tramite'},
    {text: 'Última modificación', value: 'ult_modificacion'},
    {text: 'Ver', value: 'action', align: 'center'},
  ],
  datos: [
    {nro_expediente : '800-24-04-1000/2021', extracto: 'Ayuda económica', tramite: 'Rendición de cuenta', ult_modificacion: '13-10-2021'},
    {nro_expediente : '800-24-04-1000/2021', extracto: 'Ayuda económica', tramite: 'Rendición de cuenta', ult_modificacion: '13-10-2021'},
    {nro_expediente : '800-24-04-1000/2021', extracto: 'Ayuda económica', tramite: 'Rendición de cuenta', ult_modificacion: '13-10-2021'},
  ],

  }


</script>
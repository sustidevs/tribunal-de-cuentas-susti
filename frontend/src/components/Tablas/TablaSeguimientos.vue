<template>
  <div>
    <v-data-table
        :headers="headers"
        :items="datos"
        :items-per-page="5"
        disable-sort
        mobile-breakpoint="300"
        class="elevation-1 mytable"
    >
    </v-data-table>
  </div>
</template>

<script>
export default {
  props: {
    data: Array,
  },

  data () {
    return {
      headers: [
        {text: 'Nro. de Expediente', value: 'nro_expediente'},
        {text: 'Extracto', value: 'extracto'},
        {text: 'Trámite', value: 'tramite'},
        {text: 'Última modificación', value: 'ult_modificacion'},
      ],
      datos: [
        {nro_expediente : '800-24-04-1000/2021', extracto: 'Ayuda económica', tramite: 'Rendición de cuenta', ult_modificacion: '13-10-2021'},
        {nro_expediente : '800-24-04-1000/2021', extracto: 'Ayuda económica', tramite: 'Rendición de cuenta', ult_modificacion: '13-10-2021'},
        {nro_expediente : '800-24-04-1000/2021', extracto: 'Ayuda económica', tramite: 'Rendición de cuenta', ult_modificacion: '13-10-2021'},
      ],
    }
  },
}
</script>

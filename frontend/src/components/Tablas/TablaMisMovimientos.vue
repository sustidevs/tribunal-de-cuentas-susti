<template>
  <div>
    <a>
      <v-data-table
          :headers="headers"
          :items="datos"
          :items-per-page="5"
          disable-sort
          mobile-breakpoint="300"
          class="elevation-1 mytable"
      >
      </v-data-table>
    </a>
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
        { text: 'Fecha Creación', value: 'fecha_creacion' },
        {text: 'Trámite', value: 'tramite'},
        {text: 'Área Derivada', value: 'area_derivada'},
      ],
      datos: [
        {nro_expediente : '800-24-04-1000/2021', extracto: 'RENDICION DE CUENTAS N° FDO.PTE.GTOS DECRETO IMPORTE: $ Fondo PermanenteIniciador: Ministerio de Hacienda y Finanzas', fecha_creacion: '19-11-2011', tramite: 'Fondo Permanente', area_derivada: 'Secretaría Técnica'},
        {nro_expediente : '800-24-04-1000/2021', extracto: 'RENDICION DE CUENTAS N° FDO.PTE.GTOS DECRETO IMPORTE: $ Fondo PermanenteIniciador: Ministerio de Hacienda y Finanzas', fecha_creacion: '19-11-2011', tramite: 'Fondo Permanente', area_derivada: 'Secretaría Técnica'},
        {nro_expediente : '800-24-04-1000/2021', extracto: 'RENDICION DE CUENTAS N° FDO.PTE.GTOS DECRETO IMPORTE: $ Fondo PermanenteIniciador: Ministerio de Hacienda y Finanzas', fecha_creacion: '19-11-2011', tramite: 'Fondo Permanente', area_derivada: 'Secretaría Técnica'},
      ],
    }
  },
}
</script>

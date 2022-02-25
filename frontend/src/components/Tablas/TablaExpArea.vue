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

        <template v-slot:item.action="{ }">
            <v-btn fab small color="#FACD89" depressed >
            <v-icon>mdi-hand-extended</v-icon>
            </v-btn>
        </template>
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
        {text: 'Usuario', value: 'usuario'},
        {text: 'Tomar', value: 'action', sortable: false},
      ],
      datos: [
        {nro_expediente : '800-00002/2022', extracto: 'RENDICION DE CUENTAS N° 333 FDO.PTE.GTOS DECRETO IMPORTE: $456 Fondo Permanente. Iniciador: Ministerio de Hacienda y Finanzas', fecha_creacion: '19-11-2011', tramite: 'Fondo Permanente', usuario: 'Jose Antonio Terraes'},
        {nro_expediente : '800-00006/2022', extracto: 'RENDICION DE CUENTAS N° 456 FDO.PTE.GTOS DECRETO IMPORTE: $789 Fondo Permanente. Iniciador: Ministerio de Hacienda y Finanzas', fecha_creacion: '19-11-2011', tramite: 'Subsidio', usuario: 'Mariano Gabriel Paredes'},
        {nro_expediente : '800-00025/2022', extracto: 'RENDICION DE CUENTAS N° 752 FDO.PTE.GTOS DECRETO IMPORTE: $5564 Fondo Permanente. Iniciador: Ministerio de Hacienda y Finanzas', fecha_creacion: '19-11-2011', tramite: 'Aporte no reintegrable', usuario: 'Hugo Luis Villan'},
      ],
    }
  },
}
</script>
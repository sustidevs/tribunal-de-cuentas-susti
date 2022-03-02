<template>
  <div>
    <titulo texto="Expedientes de mi Área" icono="mdi-file-marker" />
    <alert
        texto="El expediente fue tomado con éxito."
        type="success"
        :condicion="this.get_aceptado"
    />

    <tabla-exp-area
      :headers="headers"
      :data="datos"
      :loading="this.get_finalizado"
      class="mb-15 pb-15"
    />
  </div>
</template>

<script>
import Titulo from "../../components/Titulo"
import Alert from "../../components/Alert"
import TablaExpArea from "../../components/Tablas/TablaExpArea";
import {mapGetters} from "vuex";

export default {
  components: {Titulo, Alert, TablaExpArea},
  data() {
    return {
      headers: [
        {text: 'Nro. de Expediente', value: 'nro_expediente'},
        {text: 'Extracto', value: 'extracto'},
        {text: 'Fecha Creación', value: 'fecha_creacion' },
        {text: 'Trámite', value: 'tramite'},
        {text: 'Usuario', value: 'usuario'},
        {text: 'Tomar', value: 'action', align: 'center', sortable: false},
      ],
      datos: [
        {nro_expediente : '800-00002/2022', extracto: 'RENDICIÓN DE CUENTAS N° 333 FDO.PTE.GTOS DECRETO IMPORTE: $456 Fondo Permanente. Iniciador: Ministerio de Hacienda y Finanzas', fecha_creacion: '19-11-2011', tramite: 'Fondo Permanente', usuario: 'Jose Antonio Terraes', expediente_id: '1'},
        {nro_expediente : '800-00006/2022', extracto: 'RENDICIÓN DE CUENTAS N° 456 FDO.PTE.GTOS DECRETO IMPORTE: $789 Fondo Permanente. Iniciador: Ministerio de Hacienda y Finanzas', fecha_creacion: '19-11-2011', tramite: 'Subsidio', usuario: 'Mariano Gabriel Paredes', expediente_id: '2'},
        {nro_expediente : '800-00025/2022', extracto: 'RENDICIÓN DE CUENTAS N° 752 FDO.PTE.GTOS DECRETO IMPORTE: $5564 Fondo Permanente. Iniciador: Ministerio de Hacienda y Finanzas', fecha_creacion: '19-11-2011', tramite: 'Aporte no reintegrable', usuario: 'Hugo Luis Villan', expediente_id: '3'},
      ],
    }
  },

  computed: mapGetters(['get_aceptado', 'get_finalizado']),

}
</script>
<style>
.descripcion {
  font-family: Montserrat-Regular;
  font-size: 20px;
}
</style>

<template>
  <div>
    <titulo texto="Expedientes del Área" icono="mdi-file-marker" />
    <div class="descripcion text-justify py-4">
      Si desea <strong>tomar</strong> un expediente que <strong>está siendo tramitado por otro empleado del área</strong>, haga clic en el botón de la tabla.
    </div>
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
  name: 'Expedientes del Área',
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
        {nro_expediente : '800-00002/2022', extracto: 'RENDICIÓN DE CUENTAS N° 333 FDO.PTE.GTOS DECRETO IMPORTE: $456 Fondo Permanente. Iniciador: Ministerio de Hacienda y Finanzas', fecha_creacion: '19-11-2011', tramite: 'Fondo Permanente', usuario: 'Jose Antonio Terraes'},
        {nro_expediente : '800-00006/2022', extracto: 'RENDICIÓN DE CUENTAS N° 456 FDO.PTE.GTOS DECRETO IMPORTE: $789 Fondo Permanente. Iniciador: Ministerio de Hacienda y Finanzas', fecha_creacion: '19-11-2011', tramite: 'Subsidio', usuario: 'Mariano Gabriel Paredes'},
        {nro_expediente : '800-00025/2022', extracto: 'RENDICIÓN DE CUENTAS N° 752 FDO.PTE.GTOS DECRETO IMPORTE: $5564 Fondo Permanente. Iniciador: Ministerio de Hacienda y Finanzas', fecha_creacion: '19-11-2011', tramite: 'Aporte no reintegrable', usuario: 'Hugo Luis Villan'},
      ],
    }
  },

  computed: mapGetters(['get_finalizado']),

}
</script>
<style>
.descripcion {
  font-family: Montserrat-Regular;
  font-size: 20px;
}
</style>

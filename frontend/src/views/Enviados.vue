<template>
  <div>
    <titulo texto="Expedientes Enviados" icono="mdi-email-fast" />
    <tabla-enviados :headers="headers" :data="datos"/>
  </div>
</template>

<script>
import Titulo from "../components/Titulo"
import TablaEnviados from "../components/Tablas/TablaEnviados";

export default {
  name: 'Enviados',
  components: {Titulo,TablaEnviados},
  data() {
    return {
      headers: [
        { text: 'Prioridad', value: 'prioridad' },
        { text: 'Nro. de Expediente', value: 'nroexpediente' },
        { text: 'Extracto', value: 'extracto' },
        { text: 'Fecha Creación', value: '' },
        { text: 'Trámite', value: 'tramite' },
        { text: 'Cuerpo', value: 'cuerpo' },
        { text: 'Fojas', value: '' },
        { text: 'Área Origen', value: '' },
      ],
      datos: [
        {
          prioridad: 'Normal',
          nroexpediente: '800-28-04-1000/2021',
          extracto: 'Ayuda económica',
          tramite: 'Rendición de Cuenta',
          cuerpo: 1,
        },
        {
          prioridad: 'Alta',
          nroexpediente: '800-28-04-1000/2021',
          extracto: 'Ayuda económica',
          tramite: 'Rendición de Cuenta',
          cuerpo: 3,
        },
        {
          prioridad: 'Normal',
          nroexpediente: '800-28-04-1000/2021',
          extracto: 'Ayuda económica',
          tramite: 'Rendición de Cuenta',
          cuerpo: 7,
        },
      ]
    }
  },
}
</script>

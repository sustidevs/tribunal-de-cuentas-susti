<template>
  <div>
    <titulo texto="Mis Expedientes" icono="mdi-file-document" />
    <tabla-expedientes :headers="headers" :data="datos"/>
  </div>
</template>

<script>
import Titulo from "../components/Titulo"
import TablaExpedientes from "../components/Tablas/TablaExpedientes";

export default {
  name: 'MisExpedientes',
  components: {Titulo,TablaExpedientes},
  data() {
    return {
      headers: [
        { text: 'Prioridad', value: 'prioridad' },
        { text: 'Nro. de Expediente', value: 'nroexpediente' },
        { text: 'Extracto', value: 'extracto' },
        { text: 'Trámite', value: 'tramite' },
        { text: 'Cuerpo', value: 'cuerpo' },
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

  methods: {
    /**
     this.$api.post("ListadoExp", bandeja).then((response) => {
        this.BandejaEntrada = response.data;
      });**/
  },

  /**
   mounted() {
    this.$api.get('/e').then((response) => {
      console.log(response)
      this.datos = response.data; //se crea un array para guardar el contenido que devuelva el response
    })
        .catch(function (error){
          console.log(error);
        });
  }**/
}
</script>

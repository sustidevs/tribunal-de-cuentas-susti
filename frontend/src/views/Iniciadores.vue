<template>
  <div>
    <titulo texto="Iniciadores" icono="mdi-account-group" />
    <div class="descripcion text-justify py-4">Si desea <strong>editar</strong> los datos de un iniciador, haga clic en el botón de la tabla.</div>
    <tabla-iniciadores/>

  
  </div>
</template>

<script>
import Titulo from "../components/Titulo"
import TablaIniciadores from "../components/Tablas/TablaIniciadores";

export default {
  name: 'Iniciadores',
  components: {TablaIniciadores, Titulo},
  data() {
    return {
    }
  },
}
</script>

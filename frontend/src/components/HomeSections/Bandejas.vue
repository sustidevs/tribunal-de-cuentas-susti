<template>
  <div>
    <titulo-inicio texto="Bandejas"/>
    <ButtonBig class="my-2 mr-6" texto="Pendientes" link="/expedientes-pendientes" icon="mdi-clock"/>
    <ButtonBig class="my-2 mr-6" texto="Expedientes" link="/expedientes" icon="mdi-archive"/>
    <ButtonBig class="my-2 mr-6" texto="Enviados" link="/historial-enviados" icon="mdi-file-send"/>
  </div>
</template>

<script>
import ButtonBig from "../ButtonBig";
import TituloInicio from "../TituloInicio";

export default {
  components: {ButtonBig, TituloInicio}
}
</script>
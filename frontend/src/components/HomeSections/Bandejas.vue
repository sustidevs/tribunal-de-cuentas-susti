<template>
  <div>
    <titulo-inicio texto="Bandejas"/>
      <ButtonBigTooltip texto="Pendientes" link="/expedientes-pendientes" icon="mdi-clock" tooltip="Pendientes de recepción"/>
      <ButtonBigTooltip texto="Expedientes" link="/expedientes" icon="mdi-archive" tooltip="Todos los expedientes"/>
      <ButtonBig texto="Enviados" link="/historial-enviados" icon="mdi-file-send"/>
  </div>
</template>

<script>
import ButtonBig from "../ButtonBig";
import ButtonBigTooltip from "../ButtonBigTooltip";
import TituloInicio from "../TituloInicio";

export default {
  components: {ButtonBig, ButtonBigTooltip, TituloInicio}
}
</script>
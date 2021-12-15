<template>
  <v-alert
      v-if="true"
      icon="mdi-information-variant"
      dense
      prominent
      dismissible
      text
      type="info"
      class="alert Montserrat-SemiBold mt-5 sizeAlert"
      close-icon="mdi-close"
  >
    Han ingresado {{ texto }} expedientes con Motivo de SUBSIDIO y/o E/CTAS.APORTES NO REINTEGRABLE GASTOS
    <strong class="mx-3" style="text-decoration: underline">Ver Expedientes</strong>
  </v-alert>
</template>

<script>
export default {
  props: {
    texto: Number,
    condicion: Boolean,
  }
}
</script>

<style>
.sizeAlert{
  font-size: 16px !important;
}
</style>
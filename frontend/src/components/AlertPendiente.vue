<template>
  <v-alert
      icon="mdi-check"
      dense
      prominent
      text
      type="error"
      class="alert Montserrat-SemiBold mt-5 sizeAlert"
  >
    Tienes {{ cantidad }} expedientes pendientes para aceptar.
  </v-alert>
</template>

<script>
export default {
  props: {
    cantidad: Number,
  }
}
</script>

<style>
.sizeAlert{
  font-size: 16px !important;
}
</style>
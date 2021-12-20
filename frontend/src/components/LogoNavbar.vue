<template>
  <span v-if="$vuetify.breakpoint.xlOnly || $vuetify.breakpoint.lgOnly || $vuetify.breakpoint.smOnly || $vuetify.breakpoint.xsOnly">
    <img  class="mt-4" height="70" width="220" :src="'./img/logo-white.svg'">
  </span>
  <span v-else>
    <img class="mt-4" height="70" width="100" :src="'./img/logo-sin-texto.svg'">
  </span>

</template>

<script>
</script>

<template>
    <div class="Montserrat-Bold red--text fontError text-start py-2 pt-5">
      {{ texto }}
    </div>
</template>

<script>
export default {
  props: {
    texto: String
  }
}
</script>

<style>
.fontError{
  font-size: 20px !important;
}
</style>
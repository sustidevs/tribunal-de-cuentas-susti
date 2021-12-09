<template>
  <v-text-field
      class="Montserrat-Regular text-justify"
      color="amber accent-4"
      v-model="inputVal"
      outlined
      :type="tipo"
      :prepend-inner-icon="icon"
  ></v-text-field>
</template>

<script>
export default {
  props: ['value', 'tipo', 'icon'],
  data() {
    return { inputVal: this.value }
  },
  watch: {
    inputVal(val) {
      this.$emit('input', val);
    }
  }

}
</script>

<style>
.v-text-field{
  font-size: 21px !important;
}
</style>

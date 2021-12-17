<template>
  <div class="my-2">
    <div v-if="tipo == 0" >
      <extracto-loading/>
    </div>
    <div v-if="tipo==1">
      <fondo-permanente/>
    </div>
    <div v-if="tipo==2">
      <fondo-permantente-cancelacion/>
    </div>
    <div v-if="tipo==3">
      <subsidio/>
    </div>
    <div  v-if="tipo==4">
      <aporte-no-reintegrable/>
    </div>
    <!-- ID 5 - Balances -->
    <!-- ID 6 - Memorias -->
    <div v-if="tipo==7" >
      <!-- Acordada N° 32/2001 Espontánea -->
      <acordada3201/>
    </div>
    <div v-if="tipo==8 || tipo==10 || tipo==13 || tipo==15 || tipo==20">
      <acordadas-en-general/>
    </div>
    <div v-if="tipo == 9" >
      <acordada-08-05/>
    </div>
    <div v-if="tipo == 11" >
      <notas/>
    </div>
    <!-- ID 12 - Cuenta de inversión -->
    <!-- ID 14 - Arancelamiento -->
    <!-- ID 16 - Fondo federal solidario -->
    <div v-if="tipo == 17" >
      <requerimiento/>
    </div>
    <div v-if="tipo == 18" >
      <oficio/>
    </div>
    <!-- ID 19 - FO.E.SE -->
    <div v-if="tipo==21" >
      <cedula-acordada-32-01/>
    </div>
    <!-- ID 22 - Sueldos -->
    <!-- ID 23 - Cédula de Registraciones -->
    <div v-if="tipo==24" >
      <cedula-cambio-responsable/>
    </div>
    <div v-if="tipo==25" >
      <extracto-general/>
    </div>
    <div v-if="tipo==26" >
      <acordadas-en-general/>
    </div>
  </div>
</template>

<script>
import ExtractoLoading  from "./ExtractoLoading"
import FondoPermanente from "./FondoPermanente";
import FondoPermantenteCancelacion from "./FondoPermanenteCancelacion";
import Subsidio from "./Subsidio";
import AporteNoReintegrable from "./AporteNoReintegrable.vue";
import Acordada3201 from './Acordada-32-01.vue';
import AcordadasEnGeneral from "./AcordadasEnGeneral.vue";
import Acordada0805 from './Acordada-08-05.vue';
import Notas from './Notas.vue';
import Requerimiento from './Requerimiento.vue';
import Oficio from './Oficio.vue';
import CedulaAcordada3201 from "./CedulaAcordada32-01";
import CedulaCambioResponsable from "./CedulaCambioResponsable";
import ExtractoGeneral from "./ExtractoGeneral";

export default {
  name: 'Extractos',
  props: {
    tipo: Number
  },
  components: {
    ExtractoLoading,
    FondoPermanente,
    FondoPermantenteCancelacion,
    Subsidio,
    AporteNoReintegrable,
    Acordada3201,
    AcordadasEnGeneral,
    Acordada0805,
    Notas,
    Requerimiento,
    Oficio,
    CedulaAcordada3201,
    CedulaCambioResponsable,
    ExtractoGeneral,
  }
}
</script>
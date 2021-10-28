<template>
  <div class="Montserrat-SemiBold" >
    <v-app-bar class="pl-3" height="64" color="#393b44">
      <v-row justify="start">
        <LogoNavbar/>
      </v-row>
        <MensajeriaNotificacion/>
        <DropdownMenuPerfilMobile/>
    </v-app-bar>
  </div>
</template>

<script>
import LogoNavbar from "../components/LogoNavbar";
import MensajeriaNotificacion from "./MensajeriaNotificacion";
import DropdownMenuPerfilMobile from "./DropdownMenuPerfilMobile";

export default {
  components : {LogoNavbar, MensajeriaNotificacion, DropdownMenuPerfilMobile}
}

</script>
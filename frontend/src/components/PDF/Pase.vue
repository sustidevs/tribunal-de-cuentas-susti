<template>
  <div>
    <section>
      <img class="py-2" max-height="500" width="800" :src="('./img/logoPase.svg')">
    </section>

    <section>
      <div class="Montserrat-Bold sizeExpediente py-4"> EXPEDIENTE Nº 800 - 28 - 04 1000/2021 </div>
    </section>

    <section>
      <div class="d-flex flex-row py-2">
        <div class="Montserrat-Bold sizeAll">FECHA:</div>
        <div class="Montserrat-Regular pl-3 sizeAll">24/05/2021 05:16:55 PM</div>
      </div>

      <div class="d-flex flex-row py-1">
        <div class="Montserrat-Bold sizeAll">CUIT/DNI:</div>
        <div class="Montserrat-Regular pl-3 sizeAll">30562451</div>
      </div>

      <div class="d-flex flex-row py-1">
        <div class="Montserrat-Bold sizeAll"> INICIADOR:</div>
        <div class="Montserrat-Regular pl-3 sizeAll">Tribunal de Cuentas</div>
      </div>

      <div class="d-flex flex-column pt-1">
        <div class="Montserrat-Bold sizeAll">EXTRACTO:</div>
        <div class="Montserrat-Regular sizeAll">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi dolores eveniet ipsa, iste magnam modi nisi voluptate voluptatibus. Accusantium aperiam, consectetur id illum ipsum magnam natus necessitatibus omnis pariatur saepe sapiente</div>
      </div>
    </section>

  </div>

</template>

<script>

</script>

<style>
@font-face {
  font-family: Montserrat-Regular;
  src: url('/fonts/Montserrat-Regular.otf');
}

@font-face {
  font-family: Montserrat-Bold;
  src: url('/fonts/Montserrat-Bold.otf');
}

.Montserrat-Regular{
  font-family: "Montserrat-Regular",serif;
}

.Montserrat-Bold {
  font-family: "Montserrat-Bold",serif;
}

.sizeExpediente{
  font-size: 24px;
}

.sizeAll{
  font-size: 22px;
}
</style>
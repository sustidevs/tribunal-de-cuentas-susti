<template>
    <div>
        <v-row no-gutters class="justify-center pt-12">
            <v-col cols="12" lg="8">
                <v-card elevation="0" color="grey lighten-5" class="pa-8">
                    <div class="textHere Montserrat-SemiBold">
                        Pase del expediente N° 800 – 28-04 – 1000/2021
                    </div>
                    <v-divider color="#393B44"></v-divider>

                    <div class="d-flex mt-8">
                        <div class="textHereBig Montserrat-Bold"> Fecha:</div>
                        <div class="textHereSmall Montserrat-Regular ml-2"> 24-10-2021 </div>
                    </div>

                    <div class="d-flex mt-5">
                        <div class="textHereBig Montserrat-Bold"> Extracto:</div>
                        <div class="textHereSmall Montserrat-Regular ml-2 text-justify">RENDICION DE CUENTAS N° 01/20 FDO.PTE.GTOS.BIENES DE CONSUMO SERVICIOS
                    NO PERSONALES. BS. USO Y TRANSF. DCTO N° 2548/20. $1.000.000,00 (MINISTERIO REPARTICION).-……………………………………………………………… </div>
                    </div>
                    <div class="d-flex mt-5">
                        <div class="textHereBig Montserrat-Bold"> Se derivó al Área:</div>
                        <div class="textHereSmall Montserrat-Regular ml-2"> Auditores </div>
                    </div>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>
<script>
    export default {
        name: 'Carátula PDF',
    }
</script>
<style>
    .textHere{
        font-size: 30px;
        color: #616161;
    }
    .textHereBig{
        font-size: 20px;
        color: #616161;
    }
    .textHereSmall{
        font-size: 20px;
        color: #616161;
    }
    @media (max-width: 768px) {
        .textHere {
            font-size: 11px;
            color: #616161;
        }
        .textHereSmall {
            font-size: 11px;
            color: #616161;
        }
    }

</style>
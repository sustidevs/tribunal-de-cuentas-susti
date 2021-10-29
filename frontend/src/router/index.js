import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import LoginGeneral from '../views/LoginGeneral.vue'
import NuevoExpediente from '../views/NuevoExpediente.vue'
import BandejaDeEntrada from '../views/BandejaDeEntrada.vue'
import MisExpedientes from '../views/MisExpedientes.vue'
import RecuperarExpediente from '../views/RecuperarExpediente.vue'
import NuevaReunion from '../views/NuevaReunion.vue'
import NuevoPase from '../views/NuevoPase.vue'
import Seguimientos from '../views/Seguimientos.vue'
import VerSeguimientos from '../views/VerSeguimientos.vue'
import NuevoIniciador from '../views/NuevoIniciador.vue'
import CaratulaPdf from '../views/CaratulaPdf.vue'
import PasePdf from '../views/PasePdf.vue'
import layout from '../layout/Layout'

Vue.use(VueRouter)

const routes = [

  {
    path: '',
    name: 'layout',
    component: layout,
    children: [
      {
        path: '/',
        name: 'Home',
        component: Home,
        meta: {title: 'Inicio',  layout: layout }
      },
      {
        path: '/nuevo-expediente',
        name: 'Nuevo',
        component: NuevoExpediente,
        meta: { title: 'Nuevo Expediente' }
      },
      {
        path: '/expedientes-pendientes',
        name: 'Expedientes Pendientes',
        component: BandejaDeEntrada,
        meta: { title: 'Pendientes' }
      },
      {
        path: '/mis-expedientes',
        name: 'MisExpedientes',
        component: MisExpedientes,
        meta: { title: 'Mis Expedientes' }
      },
      {
        path: '/recuperar-expediente',
        name: 'recuperar-exp',
        component: RecuperarExpediente,
        meta: { title: 'Recuperar' }
      },
      {
        path: '/nueva-reunion',
        name: 'Nueva reunion',
        component: NuevaReunion,
        meta: { title: 'Nueva Reunion' }
      },
      {
        path: '/nuevo-pase',
        name: 'NuevoPase',
        component: NuevoPase,
        meta: { title: 'Nuevo Pase' }
      },
      {
        path: '/historial',
        name: 'Historial',
        component: Seguimientos,
        meta: { title: 'Historial' }
      },
      {
        path: '/ver-historiales',
        name: 'VerHistoriales',
        component: VerSeguimientos,
        meta: { title: 'Ver Historiales' }
      },
      {
        path: '/nuevo-iniciador',
        name: 'NuevoIniciador',
        component: NuevoIniciador,
        meta: { title: 'Nuevo Iniciador' }
      },
    ]
  },
  {
    path: '/login',
    name: 'LoginGeneral',
    component: LoginGeneral,
    meta: { title: 'Ingresar' }
  },
  {
    path: '/caratula',
    name: 'CaratulaPdf',
    component: CaratulaPdf,
    meta: { title: 'Carátula' }
  },
  {
    path: '/pase',
    name: 'PasePdf',
    component: PasePdf,
    meta: { title: 'Pase' }
  },

]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title;
  next();
});

export default router

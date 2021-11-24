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
import MisMovimientos from '../views/MisMovimientos.vue'
import Seguimientos from '../views/Seguimientos.vue'
import VerSeguimientos from '../views/VerSeguimientos.vue'
import NuevoIniciador from '../views/NuevoIniciador.vue'
import layout from '../layout/Layout'
import Expedientes from "../views/Expedientes";
import Enviados from "../views/Enviados";
import Usuario from "../views/Usuario";

Vue.use(VueRouter)

const routes = [

  {
    path: '',
    name: 'layout',
    component: layout,
    children: [{
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
        path: '/expedientes',
        name: 'Expedientes',
        component: Expedientes,
        meta: { title: 'Expedientes' }
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
        path: '/mis-movimientos',
        name: 'Mis Movimientos',
        component: MisMovimientos,
        meta: { title: 'Mis Movimientos' }
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
      {
        path: '/expedientes',
        name: 'Expedientes',
        component: Expedientes,
        meta: { title: 'Nueva Reunion' }
      },
      {
        path: '/enviados',
        name: 'Enviados',
        component: Enviados,
        meta: { title: 'Enviados' }
      },
      {
        path: '/usuario',
        name: 'Usuario',
        component: Usuario,
        meta: { title: 'Usuario' }
      },
    ]
  },
  {
    path: '/login',
    name: 'LoginGeneral',
    component: LoginGeneral,
    meta: { title: 'Ingresar' }
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

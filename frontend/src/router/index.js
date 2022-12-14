import Vue from 'vue'
import VueRouter from 'vue-router'
import MenuCandidatos from '../views/MenuCandidatos.vue'
import FormularioCandidatos from '../views/FormularioCandidatos.vue'
import EvaluacionCandidatos from '../views/EvaluacionCandidatos.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'MenuCandidatos',
    component: MenuCandidatos
  },
  {
    path: '/formulario',
    name: 'FormularioCandidatos',
    component: FormularioCandidatos
  },
  {
    path: '/evaluacion',
    name: 'EvaluacionCandidatos',
    component: EvaluacionCandidatos
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router

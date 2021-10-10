
import VueRouter from 'vue-router'
import Vue from 'vue'
import Home from './components/views/Home.vue'
import Matriculas from './components/views/Matriculas.vue'
// General views
import Padres from './components/views/Padres.vue'
import Alumnos from './components/views/Alumnos.vue'
import Pagos from './components/views/Pagos.vue'
import Profesores from './components/views/Profesores.vue'
import Grupos from './components/views/Grupos.vue'

// Perosnal views
import Padre from './components/Padre.vue'
import Alumno from './components/Alumno.vue'
import Profesor from './components/Profesor.vue'
import Grupo from './components/Grupo.vue'

import ProfilePDF from './components/ProfilePDF.vue'

Vue.use(VueRouter);

const router = new VueRouter({
    routes: [
        {
            path: "/",
            component: Home
        },
        {
            path: "/matriculas",
            component: Matriculas
        },
        {
            path: "/padres",
            component: Padres
        },
        {
            path: "/alumnos",
            component: Alumnos
        },
        {
            path: "/pagos",
            component: Pagos
        },
        {
            path: "/profesores",
            component: Profesores
        },
        {
            path: "/grupos",
            component: Grupos
        },
        {
            path: "/padre/:id", 
            component: Padre
        },
        {
            path: "/alumno/:id",
            component: Alumno
        },
        {
            path: "/profesor/:id",
            component: Profesor
        },
        {
            path: "/grupo/:id",
            component: Grupo

        },
        {
            path: "/profile2PDF/:id",
            component: ProfilePDF

        }

    ]

})
export default router
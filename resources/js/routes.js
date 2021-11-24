
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
import Login from './components/views/Login.vue'
import Preview from './components/views/Preview.vue'

// Perosnal views
import Padre from './components/Padre.vue'
import Alumno from './components/Alumno.vue'
import Profesor from './components/Profesor.vue'
import Grupo from './components/Grupo.vue'
import { isLoggedIn } from './utils/auth'

Vue.use(VueRouter);

const router = new VueRouter({
    routes: [
        {
            path: "/",
            component: Home,
            meta: {
                allowAnonymous: false
            }
        },
        {
            path: "/matriculas",
            component: Matriculas,
            meta: {
                allowAnonymous: false
            }
        },
        {
            path: "/padres",
            component: Padres,
            meta: {
                allowAnonymous: false
            }
        },
        {
            path: "/alumnos",
            component: Alumnos,
            meta: {
                allowAnonymous: false
            }
        },
        {
            path: "/pagos",
            component: Pagos,
            meta: {
                allowAnonymous: false
            }
        },
        {
            path: "/profesores",
            component: Profesores,
            meta: {
                allowAnonymous: false
            }
        },
        {
            path: "/grupos",
            component: Grupos,
            meta: {
                allowAnonymous: false
            }
        },
        {
            path: "/padre/:id",
            component: Padre,
            meta: {
                allowAnonymous: false
            }
        },
        {
            path: "/alumno/:id",
            component: Alumno,
            meta: {
                allowAnonymous: false
            }
        },
        {
            path: "/profesores/:id",
            component: Profesor,
            meta: {
                allowAnonymous: false
            }
        },
        {
            path: "/grupo/:id",
            component: Grupo,
            meta: {
                allowAnonymous: false
            }
        },
        {
            path: '/login',
            component: Login,
            meta: {
                allowAnonymous: true
            }
        },
        {
            path: '/preview',
            component: Preview,
            meta: {
                allowAnonymous: false
            }
        },
    ]
});

router.beforeEach((to, from, next) => {
    if (to.name == 'login' && isLoggedIn()) {
        next({ path: '/' })
    }
    else if (!to.meta.allowAnonymous && !isLoggedIn()) {
        next({
            path: '/login',
            query: { redirect: to.fullPath }
        })
    }
    else {
        next()
    }
})

export default router
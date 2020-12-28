import Vue from 'vue'
import VueRouter from 'vue-router'

import store from './store'

// ページインポート
import Top from './pages/Top.vue'
import Login from './pages/Login.vue'
import Register from './pages/Register.vue'
import PasswordConfirm from './pages/PasswordConfirm.vue'
import PasswordReset from './pages/PasswordReset.vue'
import Main from './pages/Main.vue'

Vue.use(VueRouter)

const routes = [
    { path: '/', name: 'top', component: Top },
    { path: '/login', name: 'login', component: Login,
        beforeEnter (to, from, next) {
            store.getters['auth/isLogin'] ? next('/') : next()
        }
    },
    { path: '/register', name: 'register', component: Register,
        beforeEnter (to, from, next) {
            store.getters['auth/isLogin'] ? next('/') : next()
        }
    },
    { path: '/password_confirm', name: 'password_confirm', component: PasswordConfirm,
        beforeEnter (to, from, next) {
            store.getters['auth/isLogin'] ? next('/') : next()
        }
    },
    { path: '/password_reset', name: 'password_reset', component: PasswordReset,
        beforeEnter (to, from, next) {
            store.getters['auth/isLogin'] ? next('/') : next()
        }
    },
    { path: '/main', name: 'main', component: Main,
        beforeEnter (to, from, next) {
            store.getters['auth/isLogin'] ? next() : next('/')
        }
    },
]

// VueRouterインスタンスを作成する
const router = new VueRouter({
    mode: 'history',
    routes
})

export default router

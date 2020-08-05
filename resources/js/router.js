import Vue from 'vue'
import VueRouter from 'vue-router'

import store from './store'

// ページをインポート
import Top from './pages/Top.vue'
import Login from './pages/Login.vue'
import Register from './pages/Register.vue'
import PasswordConfirm from './pages/PasswordConfirm.vue'

// VueRouterプラグインを使用する
// これによって<RouterView />コンポーネントなどを使うことができる
Vue.use(VueRouter)

// パスとコンポーネントのマッピング
const routes = [
    { path: '/', name: 'top', component: Top },
    { path: '/login', name: 'login', component: Login,
        beforeEnter (to, from, next) {
            if (store.getters['auth/isLogin']) {
                next('/')
            } else {
                next()
            }
        }
    },
    { path: '/register', name: 'register', component: Register,
        beforeEnter (to, from, next) {
            if (store.getters['auth/isLogin']) {
                next('/')
            } else {
                next()
            }
        }
    },
    { path: '/password_confirm', name: 'password_confirm', component: PasswordConfirm,
        beforeEnter (to, from, next) {
            if (store.getters['auth/isLogin']) {
                next('/')
            } else {
                next()
            }
        }
    },
]

// VueRouterインスタンスを作成する
const router = new VueRouter({
    mode: 'history',
    routes
})

export default router

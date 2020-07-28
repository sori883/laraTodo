import Vue from 'vue'
import VueRouter from 'vue-router'

// ページをインポート
import Top from './pages/Top.vue'
import Login from './pages/Login.vue'
import Register from './pages/Register.vue'

// VueRouterプラグインを使用する
// これによって<RouterView />コンポーネントなどを使うことができる
Vue.use(VueRouter)

// パスとコンポーネントのマッピング
const routes = [
    { path: '/', name: 'top', component: Top },
    { path: '/login', name: 'login', component: Login },
    { path: '/register', name: 'register', component: Register },
]

// VueRouterインスタンスを作成する
const router = new VueRouter({
    mode: 'history',
    routes
})

export default router

<template>
<div class="mx-auto col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
    <Error />
    <h2 class="card-title text-center">ログイン</h2>
    <div class="card">
        <div class="card-body">
            <form class="form" @submit.prevent="login">
                <div class="form-group">
                    <label for="emailInput">メールアドレス</label>
                    <input id="emailInput" v-model="loginForm.email" type="email" class="form-control" placeholder="メールアドレス" required>
                </div>
                <div class="form-group">
                    <label for="passwordInput">パスワード</label>
                    <input id="passwordInput" v-model="loginForm.password" type="password" class="form-control" placeholder="パスワード" required>
                </div>
                <button class="btn btn-primary btn-lg btn-block" type="submit">登録</button>
            </form>
        </div>
    </div>
</div>
</template>

<script>
import Error from '../components/Error.vue'
export default {
    components: {
        Error
    },
    data () {
        return {
            loginForm: {
                email: '',
                password: '',
                remember: 'on'
            }
        }
    },
    methods: {
        async login () {
            // authストアのresigterアクションを呼び出す
            await this.$store.dispatch('auth/login', this.loginForm)
                .then(() => {
                    this.$router.push({name: 'top'})
                })
                .catch((e) => {
                    this.$store.commit('error/setmessage', e.response.data.errors)
                })
        }
    }
}
</script>

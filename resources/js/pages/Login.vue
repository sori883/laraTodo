<template>
<b-col cols="12" sm="11" md="9" lg="7" xl="6" class="mx-auto">
    <Error />
    <h2 class="text-center">ログイン</h2>
    <b-card>
        <b-form @submit="login">
            <b-form-group id="email-group" label="メールアドレス" label-for="email">
                <b-form-input id="email" v-model="loginForm.email" type="email" required placeholder="メールアドレス"></b-form-input>
            </b-form-group>
            <b-form-group id="password-group" label="パスワード" label-for="password">
                <b-form-input id="password" v-model="loginForm.password" type="password" required placeholder="パスワード"></b-form-input>
            </b-form-group>
            <b-form-group id="remember-group">
                <b-form-checkbox v-model="loginForm.remember">ログインしたままにする</b-form-checkbox>
            </b-form-group>
            <b-button type="submit" block variant="primary">ログイン</b-button>
        </b-form>
        <div class="text-center mt-3">
            <b-link :to="{name: 'password_confirm'}">パスワード再設定</b-link>
        </div>
    </b-card>
</b-col>
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
                remember: false
            }
        }
    },
    methods: {
        async login(evt) {
            evt.preventDefault()

            await this.$store.dispatch('auth/login', this.loginForm)
                .then(() => {
                    this.$router.push({name: 'main'})
                })
                .catch((e) => {
                    this.$store.commit('error/setmessage', e.response.data.errors)
                })
        }
    }
}
</script>

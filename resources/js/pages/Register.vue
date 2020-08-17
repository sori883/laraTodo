<template>
<b-col cols="12" sm="11" md="9" lg="7" xl="6" class="mx-auto">
    <Error />
    <h2 class="text-center">ユーザ登録</h2>
    <b-card>
        <b-form @submit="register">
            <b-form-group id="user-group" label="ユーザ名" label-for="user">
                <b-form-input id="user" v-model="registerForm.name" type="text" required placeholder="ユーザ名"></b-form-input>
            </b-form-group>
            <b-form-group id="email-group" label="メールアドレス" label-for="email">
                <b-form-input id="email" v-model="registerForm.email" type="email" required placeholder="メールアドレス"></b-form-input>
            </b-form-group>
            <b-form-group id="password-group" label="パスワード" label-for="password">
                <b-form-input id="password" v-model="registerForm.password" type="password" required placeholder="パスワード"></b-form-input>
            </b-form-group>
            <b-form-group id="password-confirm-group" label="パスワード（確認）" label-for="password-confirm">
                <b-form-input id="password-confirm" v-model="registerForm.password_confirmation" type="password" required placeholder="パスワード（確認）"></b-form-input>
            </b-form-group>
            <b-button type="submit" block variant="primary">登録</b-button>
        </b-form>
        <div class="text-center mt-3">
            <b-link :to="{name: 'login'}">ログイン</b-link>
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
            registerForm: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            }
        }
    },
    methods: {
        async register(evt) {
            evt.preventDefault()

            await this.$store.dispatch('auth/register', this.registerForm)
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

<template>
<div class="mx-auto col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
    <Error />
    <h2 class="card-title text-center">ユーザ登録</h2>
    <div class="card">
        <div class="card-body">
            <form class="form" @submit.prevent="register">
                <div class="form-group">
                    <label for="usernameInput">ユーザ名</label>
                    <input id="usernameInput" v-model="registerForm.name" type="text" class="form-control" placeholder="ユーザ名" required>
                    <small id="emailHelp" class="form-text text-muted">英数字3～16文字（登録後の変更は出来ません）</small>
                </div>
                <div class="form-group">
                    <label for="emailInput">メールアドレス</label>
                    <input id="emailInput" v-model="registerForm.email" type="email" class="form-control" placeholder="メールアドレス" required>
                </div>
                <div class="form-group">
                    <label for="passwordInput">パスワード</label>
                    <input id="passwordInput" v-model="registerForm.password" type="password" class="form-control" placeholder="パスワード" required>
                </div>
                <div class="form-group">
                    <label for="passwordConfirmInput">パスワード（確認）</label>
                    <input id="passwordConfirmInput" v-model="registerForm.password_confirmation" type="password" class="form-control" placeholder="パスワード（確認）" required>
                </div>
                <button class="btn btn-primary btn-lg btn-block" type="submit">登録</button>
            </form>
            <div class="text-center mt-3">
                <router-link :to="{name: 'login'}">
                    <a>ログイン</a>
                </router-link>
            </div>
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
            registerForm: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            }
        }
    },
    methods: {
        async register() {
            // authストアのresigterアクションを呼び出す
            await this.$store.dispatch('auth/register', this.registerForm)
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

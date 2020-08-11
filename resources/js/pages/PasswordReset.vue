<template>
<div class="mx-auto col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
    <Error />
    <h2 class="card-title text-center">パスワード再設定</h2>
    <div class="card">
        <div class="card-body">
            <form class="form" @submit.prevent="passwordReset">
                <div class="form-group">
                    <label for="passwordInput">パスワード</label>
                    <input id="passwordInput" v-model="PasswordResetForm.password" type="password" class="form-control" placeholder="パスワード" required>
                </div>
                <div class="form-group">
                    <label for="passwordResetInput">パスワード（確認）</label>
                    <input id="passwordResetInput" v-model="PasswordResetForm.password_confirmation" type="password" class="form-control" placeholder="パスワード（確認）" required>
                </div>
                <button class="btn btn-primary btn-lg btn-block" type="submit">登録</button>
            </form>
        </div>
    </div>
</div>
</template>

<script>
import Cookies from 'js-cookie';
import Error from '../components/Error.vue'
export default {
    components: {
        Error
    },
    data () {
        return {
            PasswordResetForm: {
                email: '',
                password: '',
                password_confirmation: '',
                token: ''
            }
        }
    },
    methods: {
        async passwordReset() {
            await axios.post('/api/password/update', this.PasswordResetForm)
                .catch((e) => {
                    this.$store.commit('error/setmessage', e.response.data.errors)
                })
        }
    },
    created() {
        const token = Cookies.get('RESETTOKEN');
        const email = Cookies.get('EMAIL');
        console.log(email)
        if (this.PasswordResetForm.token == null) {
            this.$router.push('/');
        }
        this.PasswordResetForm.token = token;
        this.PasswordResetForm.email = email;
        console.dir(token)

        if (token) {
            Cookies.remove('RESETTOKEN');
            Cookies.remove('EMAIL');
        }
    }
}
</script>

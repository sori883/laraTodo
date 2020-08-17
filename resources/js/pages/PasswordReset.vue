<template>
<b-col cols="12" sm="11" md="9" lg="7" xl="6" class="mx-auto">
    <Error />
    <h2 class="text-center">パスワード再設定</h2>
    <b-card>
        <b-form @submit="passwordReset">
            <b-form-group id="password-group" label="パスワード" label-for="password">
                <b-form-input id="password" v-model="PasswordResetForm.password" type="password" required placeholder="パスワード"></b-form-input>
            </b-form-group>
            <b-form-group id="password-confirm-group" label="パスワード（確認）" label-for="password-confirm">
                <b-form-input id="password-confirm" v-model="PasswordResetForm.password_confirmation" type="password" required placeholder="パスワード（確認）"></b-form-input>
            </b-form-group>
            <b-button type="submit" block variant="primary">パスワードをリセット</b-button>
        </b-form>
    </b-card>
</b-col>
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
        async passwordReset(evt) {
            evt.preventDefault()

            await axios.post('/api/password/update', this.PasswordResetForm)
                .catch((e) => {
                    this.$store.commit('error/setmessage', e.response.data.errors)
                })
        }
    },
    created() {
        const token = Cookies.get('RESETTOKEN');
        const email = Cookies.get('EMAIL');
        // tokenがnullの場合はTOPにリダイレクト
        if (this.PasswordResetForm.token == null) {
            this.$router.push({name: 'top'});
        }

        this.PasswordResetForm.token = token;
        this.PasswordResetForm.email = email;

        if (token) {
            Cookies.remove('RESETTOKEN');
            Cookies.remove('EMAIL');
        }
    }
}
</script>

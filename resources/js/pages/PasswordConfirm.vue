<template>
<b-col cols="12" sm="11" md="9" lg="7" xl="6" class="mx-auto">
    <Error />
    <h2 class="text-center">パスワード再設定</h2>
    <b-card>
        <b-form @submit="passwordConfirm">
            <b-form-group id="email-group" label="メールアドレス" label-for="email">
                <b-form-input id="email" v-model="PasswordConfirmForm.email" type="email" required placeholder="メールアドレス"></b-form-input>
            </b-form-group>
            <b-button type="submit" block variant="primary">リセットメール送信</b-button>
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
            PasswordConfirmForm: {
                email: ''
            }
        }
    },
    methods: {
        async passwordConfirm(evt) {
            evt.preventDefault()

            await axios.post('/api/password/email', this.PasswordConfirmForm)
                .catch((e) => {
                    this.$store.commit('error/setmessage', e.response.data.errors)
                })
        }
    }
}
</script>

<template>
<div>
    <NavTop />
    <b-col sm="12" md="3" lg="3" xl="3" class="mx-auto">
        <div class="text-center formonly-intro">
            <img :src="'/img/icon-black.svg'">
            <p class="formonly-ttl">Reset Password</p>
        </div>
        <b-card>
            <Error />
            <b-alert variant="success" :show="successAlert">パスワードをリセットしました。</b-alert>
            <validation-observer ref="observer" v-slot="{ handleSubmit }">
                <validation-provider v-slot="validationContext" name="パスワード" :rules="{ required: true, min:8 }" vid="confirmation">
                    <b-form-group id="password-group" label="パスワード" label-for="password">
                        <b-form-input
                            id="password"
                            v-model="PasswordResetForm.password"
                            type="password"
                            :state="validationState(validationContext)"
                            aria-describedby="passwordFeedback"
                        ></b-form-input>
                        <b-form-invalid-feedback id="passwordFeedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                    </b-form-group>
                </validation-provider>

                <validation-provider v-slot="validationContext" name="パスワード（確認）" :rules="{ required: true, confirmed: 'confirmation'}">
                    <b-form-group id="password-confirm-group" label="パスワード（確認）" label-for="password-confirm">
                        <b-form-input
                            id="password-confirm"
                            v-model="PasswordResetForm.password_confirmation"
                            type="password"
                            :state="validationState(validationContext)"
                            aria-describedby="passwordConfirmFeedback"
                        ></b-form-input>
                        <b-form-invalid-feedback id="passwordConfirmFeedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                    </b-form-group>
                </validation-provider>
                <b-button block class="success" @click="handleSubmit(passwordReset)">パスワードをリセット</b-button>
            </validation-observer>
        </b-card>
    </b-col>
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
            },
            successAlert: false
        }
    },
    created() {
        const token = Cookies.get('RESETTOKEN');
        const email = Cookies.get('EMAIL');
        // tokenがnullの場合はTOPにリダイレクト
        if (typeof token === 'undefined') {
            this.$router.push({name: 'top'});
        }

        this.PasswordResetForm.token = token;
        this.PasswordResetForm.email = email;

        if (token) {
            Cookies.remove('RESETTOKEN');
            Cookies.remove('EMAIL');
        }
    },
    methods: {
        validationState({ dirty, validated, valid = null }) {
            return dirty || validated ? valid : null;
        },
        passwordReset() {
            this.$store.dispatch('auth/passwordReset', this.PasswordResetForm)
                .then(() => {
                    this.$store.commit('error/deletemessages')
                    this.successAlert = true
                })
                .catch((e) => {
                    this.successAlert = false
                    this.$store.commit('error/setmessage', e.response.data.errors)
                })
        }
    }
}
</script>

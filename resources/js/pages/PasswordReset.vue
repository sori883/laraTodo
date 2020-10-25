<template>
<b-col cols="12" sm="11" md="9" lg="7" xl="6" class="mx-auto">
    <h2 class="text-center">パスワード再設定</h2>
    <b-card>
        <validation-observer ref="observer" v-slot="{ handleSubmit }">
            <validation-provider v-slot="validationContext" name="パスワード" :rules="{ required: true }" vid="confirmation">
                <b-form-group id="password-group" label="パスワード" label-for="password">
                    <b-form-input
                        id="password"
                        v-model="PasswordResetForm.password"
                        type="password"
                        placeholder="パスワード"
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
                        placeholder="パスワード（確認）"
                        :state="validationState(validationContext)"
                        aria-describedby="passwordConfirmFeedback"
                    ></b-form-input>
                    <b-form-invalid-feedback id="passwordConfirmFeedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                </b-form-group>
            </validation-provider>
            <b-button block variant="primary" @click="handleSubmit(passwordReset)">パスワードをリセット</b-button>
        </validation-observer>
    </b-card>
</b-col>
</template>

<script>
import Cookies from 'js-cookie';
export default {
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
        }
    }
}
</script>

<template>
<b-col sm="12" md="3" lg="3" xl="3" class="mx-auto">
    <div class="text-center formonly-intro">
        <img :src="'/img/icon-black.svg'">
        <p class="formonly-ttl">Confirm Password</p>
    </div>
    <b-card>
        <Error />
        <b-alert variant="success" :show="successAlert">パスワードリセットメールを送信しました。</b-alert>
        <validation-observer ref="observer" v-slot="{ handleSubmit }">
            <validation-provider v-slot="validationContext" name="メールアドレス" :rules="{ required: true , email: true}">
                <b-form-group id="email-group" label="メールアドレス" label-for="email">
                    <b-form-input
                        id="email"
                        v-model="PasswordConfirmForm.email"
                        type="email"
                        :state="validationState(validationContext)"
                        aria-describedby="emailFeedback"
                    ></b-form-input>
                    <b-form-invalid-feedback id="emailFeedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                </b-form-group>
            </validation-provider>
            <b-button block class="success" @click="handleSubmit(passwordConfirm)">リセットメール送信</b-button>
            <div class="text-center mt-3">
                <b-link :to="{name: 'login'}">ログイン</b-link>
            </div>
        </validation-observer>
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
            },
            successAlert: false
        }
    },
    methods: {
        validationState({ dirty, validated, valid = null }) {
            return dirty || validated ? valid : null;
        },
        passwordConfirm() {
            this.$store.dispatch('auth/passwordConfirm', this.PasswordConfirmForm)
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

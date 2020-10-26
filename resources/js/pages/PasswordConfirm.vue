<template>
<b-col cols="12" sm="11" md="9" lg="7" xl="6" class="mx-auto">
    <Error />
    <h2 class="text-center">パスワード再設定</h2>
    <b-card>
        <validation-observer ref="observer" v-slot="{ handleSubmit }">
            <validation-provider v-slot="validationContext" name="メールアドレス" :rules="{ required: true , email: true}">
                <b-form-group id="email-group" label="メールアドレス" label-for="email">
                    <b-form-input
                        id="email"
                        v-model="PasswordConfirmForm.email"
                        type="email"
                        placeholder="メールアドレス"
                        :state="validationState(validationContext)"
                        aria-describedby="emailFeedback"
                    ></b-form-input>
                    <b-form-invalid-feedback id="emailFeedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                </b-form-group>
            </validation-provider>
            <b-button block variant="primary" @click="handleSubmit(passwordConfirm)">リセットメール送信</b-button>
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
            }
        }
    },
    methods: {
        validationState({ dirty, validated, valid = null }) {
            return dirty || validated ? valid : null;
        },
        passwordConfirm() {
            this.$store.dispatch('auth/passwordConfirm', this.PasswordConfirmForm)
                .catch((e) => {
                    this.$store.commit('error/setmessage', e.response.data.errors)
                })
        }
    }
}
</script>

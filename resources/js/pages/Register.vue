<template>
<b-col cols="12" sm="11" md="9" lg="7" xl="6" class="mx-auto">
    <Error />
    <h2 class="text-center">ユーザ登録</h2>
    <b-card>
        <validation-observer ref="observer" v-slot="{ handleSubmit }">
            <validation-provider v-slot="validationContext" name="ユーザ名" :rules="{ required: true, max: 255, min: 3, alpha_num: true }">
                <b-form-group id="user-group" label="ユーザ名" label-for="user">
                    <b-form-input
                        id="user"
                        v-model="registerForm.name"
                        type="text"
                        placeholder="ユーザ名"
                        :state="validationState(validationContext)"
                        aria-describedby="usernameFeedback"
                    ></b-form-input>
                    <b-form-invalid-feedback id="usernameFeedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                </b-form-group>
            </validation-provider>

            <validation-provider v-slot="validationContext" name="メールアドレス" :rules="{ required: true, email: true }">
                <b-form-group id="email-group" label="メールアドレス" label-for="email">
                    <b-form-input
                        id="email"
                        v-model="registerForm.email"
                        type="email"
                        placeholder="メールアドレス"
                        :state="validationState(validationContext)"
                        aria-describedby="usernameFeedback"
                    ></b-form-input>
                    <b-form-invalid-feedback id="usernameFeedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                </b-form-group>
            </validation-provider>

            <validation-provider v-slot="validationContext" name="パスワード" :rules="{ required: true, min: 8 }" vid="confirmation">
                <b-form-group id="password-group" label="パスワード" label-for="password">
                    <b-form-input
                        id="password"
                        v-model="registerForm.password"
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
                        v-model="registerForm.password_confirmation"
                        type="password"
                        placeholder="パスワード（確認）"
                        :state="validationState(validationContext)"
                        aria-describedby="passwordConfirmFeedback"
                    ></b-form-input>
                    <b-form-invalid-feedback id="passwordConfirmFeedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                </b-form-group>
            </validation-provider>

            <b-button block variant="primary" @click="handleSubmit(register)">登録</b-button>
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
            registerForm: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            }
        }
    },
    methods: {
        validationState({ dirty, validated, valid = null }) {
            return dirty || validated ? valid : null;
        },
        register() {
            this.$store.dispatch('auth/register', this.registerForm)
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

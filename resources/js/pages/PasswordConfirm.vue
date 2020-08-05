<template>
<div class="mx-auto col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
    <Error />
    <h2 class="card-title text-center">ログイン</h2>
    <div class="card">
        <div class="card-body">
            <form class="form" @submit.prevent="passwordConfirm">
                <div class="form-group">
                    <label for="emailInput">パスワード再設定</label>
                    <input id="emailInput" v-model="PasswordConfirmForm.email" type="email" class="form-control" placeholder="メールアドレス" required>
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
            PasswordConfirmForm: {
                email: ''
            }
        }
    },
    methods: {
        passwordConfirm() {

        }
    }
}
</script>

<template>
<div>
    <NavTop />
    <b-col cols="12" class=" top-intro">
        <b-container>
            <b-row>
                <b-col md="6" lg="6" class="align-self-center">
                    <h1>
                        タスク管理ポートフォリオ
                    </h1>
                    <p>
                        バックエンドにLaravel7.0、フロントエンドにVue2.6を使用したタスク管理アプリを作成しました。
                        <br>
                    </p>
                </b-col>
                <b-col md="6" lg="5" offset-lg="1">
                    <RegisterForm />
                </b-col>
                <b-col class="me-intro">
                    <Me />
                </b-col>
            </b-row>
        </b-container>
    </b-col>
</div>
</template>

<script>
import NavTop from '../components/navbar/NavTop.vue'
import RegisterForm from '../components/form/RegisterForm.vue'
import Me from '../components/Me.vue'
export default {
    components: {
        NavTop,
        RegisterForm,
        Me
    },
}
</script>

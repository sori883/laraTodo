<template>
<b-navbar tag="header" toggleable="lg" type="dark" class="navbar">
    <b-navbar-brand>
        <img :src="'/img/icon.svg'" class="brand-icon">
        laratodo
    </b-navbar-brand>
    <b-navbar-toggle target="nav-text-collapse"></b-navbar-toggle>

    <b-collapse id="nav-text-collapse" is-nav>
        <b-navbar-nav class="ml-auto">
            <template v-if="isLogin">
                <b-nav-item @click="logout">
                    <a class="text-white">ログアウト</a>
                </b-nav-item>
            </template>
            <template v-else>
                <b-nav-item :to="{name: 'login'}">
                    <a class="text-white">ログイン</a>
                </b-nav-item>
                <b-nav-item :to="{name: 'register'}">
                    <a class="text-white">ユーザ登録</a>
                </b-nav-item>
            </template>
        </b-navbar-nav>
    </b-collapse>
</b-navbar>
</template>
<script>
export default {
    computed: {
        isLogin () {
            return this.$store.getters['auth/isLogin']
        }
    },
    methods: {
        async logout () {
            // authストアのresigterアクションを呼び出す
            await this.$store.dispatch('auth/logout')
                .then(() => {
                    this.$router.push({name: 'top'})
                })
        }
    }
}
</script>

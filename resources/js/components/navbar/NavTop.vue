<template>
<b-navbar tag="header" toggleable="lg" type="dark" class="navbar navbar-top">
    <b-container>
        <b-navbar-brand :to="{name: 'top'}">
            <img :src="'/img/icon-white.svg'" class="brand-icon">
            laratodo
        </b-navbar-brand>
        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

        <b-collapse id="nav-collapse" is-nav>
            <b-navbar-nav class="ml-auto">
                <template v-if="isLogin">
                    <b-nav-item @click="logout">
                        <span class="text-white">Logout</span>
                    </b-nav-item>
                </template>
                <template v-else>
                    <b-nav-item :to="{name: 'login'}">
                        <span class="text-white">Sign in</span>
                    </b-nav-item>
                    <b-nav-item :to="{name: 'register'}">
                        <span class="text-white">Sign up</span>
                    </b-nav-item>
                </template>
            </b-navbar-nav>
        </b-collapse>
    </b-container>
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

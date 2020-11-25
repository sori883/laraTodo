<template>
<b-navbar tag="header" toggleable="lg" type="dark" class="navbar-main">
    <awesome-icon :icon="['fas', 'bars']" @click="toggleActive" class="toggle-sidebar-icon" />
</b-navbar>
</template>
<script>
export default {
    methods: {
        toggleActive () {
            this.$store.commit('visual/toggleSidebar')
        }
    }
}
</script>

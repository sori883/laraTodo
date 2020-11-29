<template>
<b-navbar tag="header" toggleable="lg" type="dark" class="navbar navbar-main">
    <awesome-icon :icon="['fas', 'bars']" class="toggle-sidebar-icon" @click="toggleActive" />
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

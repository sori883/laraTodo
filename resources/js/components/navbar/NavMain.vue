<template>
<b-navbar tag="header" toggleable="lg" type="dark" sticky class="navbar navbar-main">
    <button class="sidebar-toggle-icon" @click="toggleActive">
        <awesome-icon :icon="['fas', 'bars']" class="toggle-sidebar-icon" />
    </button>
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

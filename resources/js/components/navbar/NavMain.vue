<template>
<b-navbar tag="header" toggleable="lg" type="dark" class="navbar navbar-main">
    <button class="sidebar-toggle" @click="toggleActive">
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

<template>
<div v-show="messages" class="mt-3">
    <b-alert show variant="danger" class="error-alert">
        <ul class="text-left error-list">
            <li v-for="value in messages" :key="value" class="error-item">
                {{ value }}
            </li>
        </ul>
    </b-alert>
</div>
</template>

<script>
export default {
    computed: {
        messages () {
            return this.$store.getters['error/message']
        }
    },
    destroyed() {
        this.$store.commit('error/deletemessages')
    }
}
</script>

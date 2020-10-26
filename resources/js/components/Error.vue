<template>
<div v-show="messages" class="mt-3">
    <b-alert show variant="danger">
        <ul class="text-left">
            <li v-for="value in messages" :key="value">
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

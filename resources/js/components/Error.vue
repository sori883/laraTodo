<template>
<div v-show="messages" class="mt-3">
    <div class="alert alert-danger" role="alert">
        <ul class="text-left">
            <li v-for="value in messages" :key="value">
                {{ value }}
            </li>
        </ul>
    </div>
</div>
</template>

<script>
export default {
    computed: {
        messages () {
            return this.$store.getters['projects/projects']
        }
    },
    methods: {
        async deleteMessages () {
            await this.$store.dispatch('projects/deletemessages')
        }
    }
}
</script>

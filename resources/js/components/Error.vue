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
import { mapGetters, mapMutations } from 'vuex'
export default {
    computed: {
        ...mapGetters({
            messages: 'error/message'
        })
    },
    methods: {
        ...mapMutations('error', ['deleteMessage'])
    }
}
</script>

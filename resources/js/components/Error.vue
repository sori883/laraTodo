<template>
<div v-show="message" class="mt-3">
    <div class="alert alert-danger" role="alert">
        <ul class="text-left">
            <li v-for="(value, key) in message" :key="key">
                {{ value[0] }}
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
            message: 'error/message'
        })
    },
    methods: {
        ...mapMutations('error', ['deleteMessage'])
    }
}
</script>

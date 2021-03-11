<template>
<b-modal id="taskDeleteModal" title="タスク削除">
    {{ selectedTask.title }}
    <template v-slot:modal-footer="{ cancel }">
        <b-button @click="cancel()">キャンセル</b-button>
        <b-button variant="danger" @click="delTask">削除</b-button>
    </template>
</b-modal>
</template>

<script>
export default {
    computed: {
        selectedTask () {
            const selectedTask = this.$store.getters['tasks/selectedTask']
            if (!selectedTask) {
                // TODO errorストアにしたい
                return {title: 'no selected tasks'}
            }

            return selectedTask
        }
    },
    methods: {
        delTask () {
            this.$store.dispatch('tasks/delTask', this.selectedTask.id)
                .then(() => {
                    this.$bvModal.hide('taskDeleteModal')
                })
        }
    }
}
</script>

<template>
<b-modal id="ProjectDeleteModal" title="プロジェクト削除">
    {{ selectedProject.title }}
    <template v-slot:modal-footer="{ cancel }">
        <b-button @click="cancel()">キャンセル</b-button>
        <b-button variant="danger" @click="delProject">削除</b-button>
    </template>
</b-modal>
</template>

<script>
export default {
    computed: {
        selectedProject () {
            const selectedProject = this.$store.getters['projects/selectedProject']
            if (!selectedProject) {
                // TODO errorストアにしたい
                return {title: 'inbox'}
            }

            return selectedProject
        }
    },
    methods: {
        delProject () {
            this.$store.dispatch('projects/delProject', this.selectedProject.id)
                .then(() => {
                    this.$bvModal.hide('ProjectDeleteModal')
                })
        }
    }
}
</script>

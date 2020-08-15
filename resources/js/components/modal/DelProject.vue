<template>
<div id="ProjectDeleteModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ selectedProject.title }}
            </div>
            <div class="modal-footer justify-content-between">
                <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                <button @click="delProject" type="submit" class="btn btn-danger">削除する</button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    computed: {
        selectedProject () {
            const selectedProject = this.$store.getters['projects/selectedProject']
            if (!selectedProject) {
                // TODO errorストアにしたい
                return {title: 'not selected project'}
            }

            return selectedProject
        }
    },
    methods: {
        delProject () {
            this.$store.dispatch('projects/delProject', this.selectedProject.id)
            // bootstrapModalの非表示
            $('#ProjectDeleteModal').modal('hide');
        }
    }
}
</script>

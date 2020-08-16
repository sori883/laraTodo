<template>
<div class="modal fade" id="projectCreateModal" tabindex="-1" role="dialog" aria-labelledby="projectCreateModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="projectCreateModalTitle">プロジェクト作成</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="projectInput">プロジェクト名</label>
                    <input v-model="projectForm.title" type="text" class="form-control" id="projectInput" name="title" placeholder="プロジェクト名">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                <button class="btn btn-primary" @click="createProject">作成</button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data () {
        return {
            projectForm: {
                title: ''
            }
        }
    },
    methods: {
        createProject () {
            this.$store.dispatch('projects/createProject', this.projectForm)
        }
    }
}
</script>

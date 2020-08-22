<template>
<b-modal id="projectCreateModal" title="プロジェクト作成">
    <b-form-group id="project-create-group" label="プロジェクト名" label-for="email">
        <b-form-input id="title" v-model="projectForm.title" type="text" required placeholder="プロジェクト名"></b-form-input>
    </b-form-group>
    <template v-slot:modal-footer="{ cancel }">
        <b-button variant="danger" @click="cancel()">キャンセル</b-button>
        <b-button variant="success" @click="createProject">作成</b-button>
    </template>
</b-modal>
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
                .then(() => {
                    // プロジェクト作成後にフォーム値をリセット
                    this.projectForm.title = ''
                    this.$bvModal.hide('projectCreateModal')
                })
        }
    }
}
</script>

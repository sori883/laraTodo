<template>
<b-modal id="projectEditModal" title="プロジェクト編集" @show="setProjectTitle">
    <b-form-group id="project-edit-group" label="プロジェクト名" label-for="email">
        <b-form-input id="title" v-model="projectForm.title" type="text" required placeholder="プロジェクト名"></b-form-input>
    </b-form-group>
    <template v-slot:modal-footer="{ cancel }">
        <b-button variant="danger" @click="cancel()">キャンセル</b-button>
        <b-button variant="success" @click="editProject">編集</b-button>
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
                return {title: 'not selected project'}
            }

            return selectedProject
        }
    },
    data () {
        return {
            projectForm: {
                title: ''
            }
        }
    },
    methods: {
        setProjectTitle () {
            this.projectForm.title = this.selectedProject.title
        },
        editProject () {
            // TODO editアクションを作成
            this.$store.dispatch('projects/editProject', {projectId: this.selectedProject.id, data: this.projectForm})
                .then(() => {
                    // プロジェクト作成後にフォーム値をリセット
                    // this.projectForm.title = ''
                    this.$bvModal.hide('projectEditModal')
                })
        }
    }
}
</script>

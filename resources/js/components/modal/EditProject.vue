<template>
<validation-observer ref="observer" v-slot="{ handleSubmit }">
    <b-modal id="projectEditModal" title="プロジェクト編集" @show="setProject">
        <validation-provider v-slot="validationContext" name="プロジェクト名" :rules="{ required: true, max: 20 }">
            <b-form-group id="project-edit-group" label="プロジェクト名" label-for="email">
                <b-form-input
                    id="title"
                    v-model="projectForm.title"
                    type="text"
                    :state="validationState(validationContext)"
                    aria-describedby="titleFeedback"
                    placeholder="プロジェクト名"
                ></b-form-input>
                <b-form-invalid-feedback id="titleFeedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
            </b-form-group>
        </validation-provider>
        <template v-slot:modal-footer="{ cancel }">
            <b-button variant="danger" @click="cancel()">キャンセル</b-button>
            <b-button variant="success" @click="handleSubmit(editProject)">編集</b-button>
        </template>
    </b-modal>
</validation-observer>
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
        validationState({ dirty, validated, valid = null }) {
            return dirty || validated ? valid : null;
        },
        setProject () {
            this.projectForm.title = this.selectedProject.title
        },
        editProject () {
            this.$store.dispatch('projects/editProject', {projectId: this.selectedProject.id, data: this.projectForm})
                .then(() => {
                    this.$bvModal.hide('projectEditModal')
                })
        }
    }
}
</script>

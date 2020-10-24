<template>
<validation-observer ref="observer" v-slot="{ handleSubmit }">
    <b-modal id="projectCreateModal" title="プロジェクト作成">
        <validation-provider name="プロジェクト名" :rules="{ required: true, max: 20 }" v-slot="validationContext">
            <b-form-group id="project-create-group" label="プロジェクト名" label-for="project-title">
                <b-form-input
                    id="title"
                    name="title"
                    v-model="projectForm.title"
                    type="text"
                    placeholder="プロジェクト名"
                    :state="validationState(validationContext)"
                    aria-describedby="inputFeedback"
                ></b-form-input>
                <b-form-invalid-feedback id="inputFeedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
            </b-form-group>
        </validation-provider>
        <template v-slot:modal-footer="{ cancel }">
            <b-button variant="danger" @click="cancel()">キャンセル</b-button>
            <b-button variant="success" @click="handleSubmit(createProject)">作成</b-button>
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
    methods: {
        validationState({ dirty, validated, valid = null }) {
            return dirty || validated ? valid : null;
        },
        createProject () {
            this.$store.dispatch('projects/createProject', this.projectForm)
                .then(() => {
                    // プロジェクト作成後にフォーム値をリセット
                    this.projectForm.title = ''
                    this.$nextTick(() => {
                        this.$refs.observer.reset();
                    });
                    this.$bvModal.hide('projectCreateModal')
                })
        }
    }
}
</script>

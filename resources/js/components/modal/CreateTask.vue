<template>
<validation-observer ref="observer" v-slot="{ handleSubmit }">
    <b-modal id="taskCreateModal" title="タスク作成">
        <validation-provider v-slot="validationContext" name="タスク名" :rules="{ required: true, max: 50 }">
            <b-form-group id="task-create-name" label="タスク名" label-for="email">
                <b-form-input
                    id="title"
                    v-model="taskForm.title"
                    type="text"
                    placeholder="タスク名"
                    :state="validationState(validationContext)"
                    aria-describedby="titleFeedback"
                ></b-form-input>
                <b-form-invalid-feedback id="titleFeedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
            </b-form-group>
        </validation-provider>

        <b-form-group id="task-create-datatime" label="期限" label-for="email">
            <VueCtkDateTimePicker v-model="taskForm.limit_at" label="日時を選択してください" :format="'YYYY/MM/DD HH:mm'" no-header />
        </b-form-group>

        <b-form-group id="task-create-datatime" label="プロジェクト" label-for="email">
            <b-form-select v-model="taskForm.project_id">
                <template v-slot:first>
                    <b-form-select-option :value="null">インボックス</b-form-select-option>
                </template>
                <template v-for="project in projects">
                    <b-form-select-option :value="project.id">{{ project.title }}</b-form-select-option>
                </template>
            </b-form-select>
        </b-form-group>

        <template v-slot:modal-footer="{ cancel }">
            <b-button variant="danger" @click="cancel()">キャンセル</b-button>
            <b-button variant="success" @click="handleSubmit(createTask)">作成</b-button>
        </template>
    </b-modal>
</validation-observer>
</template>

<script>
export default {
    data () {
        return {
            taskForm: {
                title: '',
                limit_at: '',
                project_id: null
            },
        }
    },
    computed: {
        projects () {
            return this.$store.getters['projects/projects']
        }
    },
    methods: {
        validationState({ dirty, validated, valid = null }) {
            return dirty || validated ? valid : null;
        },
        createTask () {
            this.$store.dispatch('tasks/createTask', this.taskForm)
                .then(() => {
                    // フォームリセット
                    this.taskForm.title = ''
                    this.$nextTick(() => {
                        this.$refs.observer.reset();
                    });
                    this.$bvModal.hide('taskCreateModal')
                })
        }
    }
}
</script>

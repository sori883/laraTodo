<template>
<validation-observer ref="observer" v-slot="{ handleSubmit }">
    <b-modal id="taskEditModal" title="タスク編集" @show="setTaskTitle">
        <validation-provider v-slot="validationContext" name="タスク名" :rules="{ required: true, max: 50 }">
            <b-form-group id="task-edit-name" label="タスク名" label-for="email">
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

        <b-form-group id="task-edit-datatime" label="期限" label-for="email">
            <VueCtkDateTimePicker v-model="taskForm.limit_at" label="日時を選択してください" :format="'YYYY/MM/DD HH:mm'" no-header />
        </b-form-group>

        <b-form-group id="task-edit-datatime" label="タスクを移動" label-for="email">
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
            <b-button variant="success" @click="handleSubmit(editTask)">編集</b-button>
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
        selectedTask () {
            const selectedTask = this.$store.getters['tasks/selectedTask']
            if (!selectedTask) {
                // TODO errorストアにしたい
                return {title: 'no selected tasks'}
            }

            return selectedTask
        },
        projects () {
            return this.$store.getters['projects/projects']
        }
    },
    methods: {
        validationState({ dirty, validated, valid = null }) {
            return dirty || validated ? valid : null;
        },
        setTaskTitle () {
            this.taskForm.title = this.selectedTask.title
            this.taskForm.limit_at = this.selectedTask.limit_at,
            this.taskForm.project_id = this.selectedTask.project_id
        },
        editTask () {
            this.$store.dispatch('tasks/editTask', {taskId: this.selectedTask.id, data: this.taskForm})
                .then(() => {
                    this.$bvModal.hide('taskEditModal')
                })
        },
    }
}
</script>

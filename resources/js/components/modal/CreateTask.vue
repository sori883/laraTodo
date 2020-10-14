<template>
<b-modal id="taskCreateModal" title="タスク作成">
    <b-form-group id="task-create-name" label="タスク名" label-for="email">
        <b-form-input id="title" v-model="taskForm.title" type="text" required placeholder="タスク名"></b-form-input>
    </b-form-group>

    <b-form-group id="task-create-datatime" label="期限" label-for="email">
        <VueCtkDateTimePicker v-model="taskForm.limit_at" label="日時を選択してください" :format="'YYYY/MM/DD HH:mm'" no-header />
    </b-form-group>

    <b-form-group id="task-create-datatime" label="タスクを移動" label-for="email">
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
        <b-button variant="success" @click="createTask">作成</b-button>
    </template>
</b-modal>
</template>

<script>
export default {
    computed: {
        projects () {
            return this.$store.getters['projects/projects']
        }
    },
    data () {
        return {
            taskForm: {
                title: '',
                limit_at: '',
                project_id: null
            },
        }
    },
    methods: {
        createTask () {
            this.$store.dispatch('tasks/createTask', this.taskForm)
                .then(() => {
                    // プロジェクト作成後にフォーム値をリセット
                    this.taskForm.title = ''
                    this.$bvModal.hide('taskCreateModal')
                })
        }
    }
}
</script>

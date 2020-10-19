<template>
<li class="nav-item border-bottom">
    <div class="d-flex justify-content-between pt-3">
        <span class="task-title">
            <b-icon @click="compliteTask" icon="circle" font-scale="0.8"></b-icon>
            {{ task.title }}
        </span>
        <div>
            <b-dropdown size="MD" variant="link" no-caret>
                <template v-slot:button-content>
                    <i class="fas fa-ellipsis-h text-muted"></i>
                </template>

                <b-dropdown-item @click="selectedTask" v-b-modal.taskEditModal>タスク編集</b-dropdown-item>
                <b-dropdown-divider></b-dropdown-divider>
                <b-dropdown-item @click="selectedTask" v-b-modal.taskDeleteModal link-class="text-danger">タスク削除</b-dropdown-item>
            </b-dropdown>
        </div>
    </div>
    <div class="mt-2 mb-1" v-show="task.limit_at">
        <small><i class="fas fa-calendar-day d-inline mr-1"></i>{{ task.limit_at }}</small>
    </div>
</li>
</template>

<script>
export default {
    props: {
        task: {
            type: Object,
            required: true
        }
    },
    methods: {
        selectedTask () {
            this.$store.commit('tasks/setSelectedTask', this.task)
        },
        compliteTask () {
            this.$store.dispatch('tasks/compliteTask', this.task.id)
        }
    }
}
</script>

<template>
<li class="nav-item border-bottom">
    <div class="d-flex justify-content-between pt-3">
        <span class="task-title">
            <b-icon icon="circle" font-scale="0.8" @click="compliteTask"></b-icon>
            {{ task.title }}
        </span>
        <div>
            <b-dropdown size="MD" variant="link" no-caret>
                <template v-slot:button-content>
                    <i class="fas fa-ellipsis-h text-muted"></i>
                </template>

                <b-dropdown-item v-b-modal.taskEditModal @click="selectedTask">タスク編集</b-dropdown-item>
                <b-dropdown-divider></b-dropdown-divider>
                <b-dropdown-item v-b-modal.taskDeleteModal link-class="text-danger" @click="selectedTask">タスク削除</b-dropdown-item>
            </b-dropdown>
        </div>
    </div>
    <div v-show="task.limit_at" class="mt-2 mb-1">
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

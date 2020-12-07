<template>
<li class="nav-item border-bottom">
    <div class="d-flex justify-content-between pt-3">
        <div>
            <div class="task-title d-flex align-items-center">
                <div class="task-complite-circle" @click="compliteTask">
                    <awesome-icon :icon="['fas', 'check']" class="task-complite-check" />
                </div>
                <span>{{ task.title }}</span>
            </div>
            <small v-if="task.limit_at" :class="[limitAt ? 'text-danger' : 'text-muted']">
                <awesome-icon :icon="['fas', 'calendar-day']" />
                {{ task.limit_at | moment("YYYY年MM月DD日 h時mm分") }}
            </small>
        </div>
        <div>
            <b-dropdown size="sm" variant="link" no-caret>
                <template v-slot:button-content>
                    <awesome-icon :icon="['fas', 'ellipsis-h']" class="text-muted" />
                </template>

                <b-dropdown-item v-b-modal.taskEditModal @click="selectedTask">タスク編集</b-dropdown-item>
                <b-dropdown-divider></b-dropdown-divider>
                <b-dropdown-item v-b-modal.taskDeleteModal link-class="text-danger" @click="selectedTask">タスク削除</b-dropdown-item>
            </b-dropdown>
        </div>
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
    data () {
        return {
            limitAt: false
        }
    },
    created() {
        if (!this.task.limit_at) {
            return
        }

        const today = this.$moment().format()
        if (this.$moment(this.task.limit_at).isAfter(today)) {
            this.limitAt = true
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

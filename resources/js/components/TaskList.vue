<template>
<div class="task-list">
    <h2 class="py-3">{{ selectedProject.title }}</h2>
    <ul class="nav flex-column pt-2">
        <Task
            v-for="task in tasks"
            :key="task.id"
            :task="task"
        />
    </ul>
</div>
</template>

<script>
import Task from './tasks/Task.vue'
export default {
    components: {
        Task
    },
    computed: {
        tasks () {
            return this.$store.getters['tasks/tasks']
        },
        selectedProject () {
            const selectedProject = this.$store.getters['projects/selectedProject']
            if (!selectedProject) {
                return {title: 'inbox'}
            }
            return selectedProject
        }
    },
    watch: {
        $route: {
            async handler () {
                await this.fetchInboxTasks()
            },
            immediate: true
        },
        selectedProject: {
            async handler () {
                await this.fetchProjectTasks()
            },
        }
    },
    methods: {
        async fetchInboxTasks () {
            await this.$store.dispatch('tasks/inboxTasks')
        },
        async fetchProjectTasks () {
            await this.$store.dispatch('tasks/projectTasks', this.selectedProject.id)
        },
    }
}
</script>

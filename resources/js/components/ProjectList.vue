<template>
<nav class="col-md-3 d-md-block sidebar">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <span class="nav-link" @click="selectedProject">
                    <i class="fas fa-inbox"></i>
                    インボックス <span class="sr-only">(current)</span>
                </span>
            </li>
        </ul>

        <h6 class="d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>プロジェクト</span>
            <span v-b-modal.projectCreateModal class="text-muted">
                <i class="fas fa-plus-circle"></i>
            </span>
        </h6>
        <ul class="nav flex-column mb-2">
            <Project
                v-for="project in projects"
                :key="project.id"
                :project="project"
            />
        </ul>
    </div>
</nav>
</template>

<script>
import Project from './projects/Project.vue'
export default {
    components: {
        Project
    },
    computed: {
        projects () {
            return this.$store.getters['projects/projects']
        }
    },
    methods: {
        async fetchProjects () {
            await this.$store.dispatch('projects/allProjects')
        },
        selectedProject () {
            this.$store.commit('projects/setSelectedProject', null)
        }
    },
    watch: {
        $route: {
            async handler () {
                await this.fetchProjects()
            },
            immediate: true
        }
    }
}
</script>

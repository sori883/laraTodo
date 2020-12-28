<template>
<nav :class="{ 'switch': sidebarHidden }" class="sidebar">
    <div class="sidebar-body">
        <ul class="nav flex-column">
            <li class="nav-item">
                <span class="nav-link" @click="selectedProject">
                    <awesome-icon :icon="['fas', 'inbox']" />
                    インボックス <span class="sr-only">(current)</span>
                </span>
            </li>
        </ul>

        <h6 class="d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>プロジェクト</span>
            <span v-b-modal.projectCreateModal class="create-project-btn">
                <awesome-icon :icon="['fas', 'plus-circle']" />
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
        },
        sidebarHidden () {
            return this.$store.getters['visual/sidebarHidden']
        }
    },
    watch: {
        $route: {
            async handler () {
                await this.fetchProjects()
            },
            immediate: true
        }
    },
    methods: {
        async fetchProjects () {
            await this.$store.dispatch('projects/allProjects')
        },
        selectedProject () {
            this.$store.commit('projects/setSelectedProject', null)
        }
    }
}
</script>

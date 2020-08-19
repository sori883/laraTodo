<template>
<b-sidebar id="sidebar" class="sidebar" title="Sidebar" visible z-index="-1">
    <div class="px-1 py-3">
        <b-nav vertical>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-inbox"></i>
                    インボックス <span class="sr-only">(current)</span>
                </a>
            </li>
        </b-nav>

        <h6 class="d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>プロジェクト</span>
            <span class="text-muted" v-b-modal.projectCreateModal>
                <i class="fas fa-plus-circle"></i>
            </span>
        </h6>
        <b-nav vertical>
            <Project
                v-for="project in projects"
                :key="project.id"
                :project="project"
            />
        </b-nav>
    </div>
</b-sidebar>
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

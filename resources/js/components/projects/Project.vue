<template>
<li class="nav-item d-flex justify-content-between align-items-center pr-3" @click="selectedProject">
    <span class="nav-link">
        <i class="fas fa-folder"></i>
        {{ project.title }}
    </span>
    <b-dropdown size="lg" variant="link" no-caret>
        <template v-slot:button-content>
            <i class="fas fa-ellipsis-h text-muted"></i>
        </template>

        <b-dropdown-item v-b-modal.projectEditModal @click="selectedProject">プロジェクトを編集</b-dropdown-item>
        <b-dropdown-divider></b-dropdown-divider>
        <b-dropdown-item v-b-modal.ProjectDeleteModal link-class="text-danger" @click="selectedProject">プロジェクトを削除</b-dropdown-item>
    </b-dropdown>
</li>
</template>

<script>
export default {
    props: {
        project: {
            type: Object,
            required: true
        }
    },
    methods: {
        selectedProject () {
            this.$store.commit('projects/setSelectedProject', this.project)
        }
    }
}
</script>

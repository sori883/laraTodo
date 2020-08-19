<template>
<li class="nav-item d-flex justify-content-between align-items-center pr-3">
    <a class="nav-link">
        <i class="fas fa-folder"></i>
        {{ project.title }}
    </a>
    <b-dropdown size="lg" variant="link" no-caret>
        <template v-slot:button-content>
            <i class="fas fa-ellipsis-h text-muted"></i>
        </template>

        <b-dropdown-item @click="selectedProject" v-b-modal.projectEditModal>プロジェクトを編集</b-dropdown-item>
        <b-dropdown-divider></b-dropdown-divider>
        <b-dropdown-item @click="selectedProject" link-class="text-danger" v-b-modal.ProjectDeleteModal>プロジェクトを削除</b-dropdown-item>
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

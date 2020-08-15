<template>
<li class="nav-item d-flex justify-content-between align-items-center pr-3">
    <a class="nav-link">
        <i class="fas fa-folder"></i>
        {{ project.title }}
    </a>
    <div class="dropdown">
        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-h text-muted"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" data-toggle="modal" data-target="#ProjectEditModal">
                プロジェクトを編集
            </a>
            <div class="dropdown-divider"></div>
            <a @click="selectedProject" class="dropdown-item text-danger" data-toggle="modal" data-target="#ProjectDeleteModal">
                プロジェクトを削除
            </a>
        </div>
    </div>
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
            this.$store.dispatch('projects/selectedProject', this.project)
        }
    }
}
</script>

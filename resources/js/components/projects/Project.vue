<template>
<li
    class="nav-item d-flex justify-content-between align-items-center pr-3"
    @click="selectedProject"
    @mouseover="showIcon"
    @mouseleave="hideIcon"
>
    <span class="nav-link">
        {{ project.title }}
    </span>
    <b-dropdown size="sm" variant="link" no-caret>
        <template v-slot:button-content>
            <awesome-icon v-show="visibleIcon" :icon="['fas', 'ellipsis-h']" class="text-muted menu-icon" />
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
    data () {
        return {
            visibleIcon: false
        }
    },
    methods: {
        selectedProject () {
            this.$store.commit('projects/setSelectedProject', this.project)
        },
        showIcon () {
            this.visibleIcon = true
        },
        hideIcon () {
            this.visibleIcon = false
        }
    }
}
</script>

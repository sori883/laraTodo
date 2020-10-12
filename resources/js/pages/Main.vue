<template>
<b-container fluid>
    <b-row>
        <ProjectList />
        <TaskList />
        <DelProject />
        <CreateProject />
        <EditProject />
        <DelTask />
        <CreateTask />
        <EditTask />
    </b-row>
    <div class="task-create-button">
        <b-button pill v-b-modal.taskCreateModal>Button</b-button>
    </div>
</b-container>
</template>

<script>
// Project
import ProjectList from '../components/ProjectList.vue'
import DelProject from '../components/modal/DelProject.vue'
import CreateProject from '../components/modal/CreateProject.vue'
import EditProject from '../components/modal/EditProject.vue'
// Task
import TaskList from '../components/TaskList.vue'
import DelTask from '../components/modal/DelTask.vue'
import CreateTask from '../components/modal/CreateTask.vue'
import EditTask from '../components/modal/EditTask.vue'
export default {
    components: {
        ProjectList,
        DelProject,
        CreateProject,
        EditProject,
        TaskList,
        DelTask,
        CreateTask,
        EditTask
    }
}
</script>

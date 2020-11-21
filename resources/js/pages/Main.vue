<template>
<main>
    <NavMain />
    <div class="wrapper">
        <ProjectList />
        <TaskList />
    </div>
    <DelProject />
    <CreateProject />
    <EditProject />
    <DelTask />
    <CreateTask />
    <EditTask />
    <div class="task-create-button">
        <b-button v-b-modal.taskCreateModal pill>Button</b-button>
    </div>
</main>
</template>

<script>
import NavMain from '../components/navbar/NavMain.vue'
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
        NavMain,
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

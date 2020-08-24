<template>
<b-container fluid>
    <b-row>
        <ProjectList />
        <TaskList />
        <DelProject />
        <CreateProject />
        <EditProject />
    </b-row>
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
export default {
    components: {
        ProjectList,
        DelProject,
        CreateProject,
        EditProject,
        TaskList
    }
}
</script>

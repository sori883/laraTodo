<template>
<b-container fluid>
    <b-row>
        <ProjectList />
        <DelProject />
        <CreateProject />
        <EditProject />
    </b-row>
</b-container>
</template>

<script>
import ProjectList from '../components/ProjectList.vue'
import DelProject from '../components/modal/DelProject.vue'
import CreateProject from '../components/modal/CreateProject.vue'
import EditProject from '../components/modal/EditProject.vue'
export default {
    components: {
        ProjectList,
        DelProject,
        CreateProject,
        EditProject
    }
}
</script>

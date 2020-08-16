<template>
<div class="container-fluid">
    <div class="row">
        <ProjectList />
        <DelProject />
        <CreateProject />
    </div>
</div>
</template>

<script>
import ProjectList from '../components/ProjectList.vue'
import DelProject from '../components/modal/DelProject.vue'
import CreateProject from '../components/modal/CreateProject.vue'
export default {
    components: {
        ProjectList,
        DelProject,
        CreateProject
    }
}
</script>

<template>
<div class="container-fluid">
    <div class="row">
        <ProjectList />
        <DelProject />
    </div>
</div>
</template>

<script>
import ProjectList from '../components/ProjectList.vue'
import DelProject from '../components/confirm/DelProject.vue'
export default {
    components: {
        ProjectList,
        DelProject
    }
}
</script>

<template>
<div>
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
        <b-button v-b-modal.taskCreateModal pill>
            <awesome-icon :icon="['fas', 'plus']" />
        </b-button>
    </div>
</div>
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

import { getScrolllbarWidth } from '../mixins/fix.js'
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
    },
    mounted() {
        if (getScrolllbarWidth() === 0) {
            // スクロールバーが表示されていない状態でpadding-rightが表示される現象を修正
            this.$root.$on('bv::modal::show', () => {
                document.body.classList.add('fix-modal-padding')
            })
            this.$root.$on('bv::modal::hidden', () => {
                document.body.classList.remove('fix-modal-padding')
            })
        }
    },
}
</script>

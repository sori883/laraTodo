const state = {
    tasks: null,
    selectedTask: null
}

const getters = {
    tasks: (state) => state.tasks,
    selectedTask: (state) => state.selectedTask
}

const mutations = {
    setTasks (state, Tasks) {
        state.tasks = Tasks
    },
    setSelectedTask (state, selectedTask) {
        state.selectedTask = selectedTask
    }
}

const actions = {
    async inboxTasks (context) {
        const response = await axios.get('/api/tasks/index')
        context.commit('setTasks', response.data)
    },
    async projectTasks (context, taskId) {
        let response
        if (typeof taskId === 'undefined') {
            // taskIdがnullの場合はinboxのタスクを取得する
            response = await axios.get('/api/tasks/index')
        } else {
            response = await axios.get(`/api/tasks/project/${taskId}`)
        }
        context.commit('setTasks', response.data)
    },
    async createTask (context, data) {
        const response = await axios.post('/api/tasks/store', data)
        context.commit('setTasks', response.data)
    },
    async editTask (context, {taskId, data}) {
        console.log(data)
        const response = await axios.patch(`/api/tasks/update/${taskId}`, data)
        context.commit('setTasks', response.data)
    },
    async delTask (context, taskId) {
        const response = await axios.delete(`/api/tasks/destroy/${taskId}`)
        context.commit('setTasks', response.data)
    },
    async compliteTask (context, taskId) {
        const response = await axios.patch(`/api/tasks/complite/${taskId}`)
        context.commit('setTasks', response.data)
    },
    async uncompliteTask (context, taskId) {
        const response = await axios.patch(`/api/tasks/uncomplite/${taskId}`)
        context.commit('setTasks', response.data)
    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}

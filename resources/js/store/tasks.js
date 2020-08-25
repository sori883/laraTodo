const state = {
    tasks: null
}

const getters = {
    tasks: (state) => state.tasks
}

const mutations = {
    setTasks (state, Tasks) {
        state.tasks = Tasks
    },
}

const actions = {
    async inboxTasks (context) {
        const response = await axios.get('/api/tasks/index')
        context.commit('setTasks', response.data)
    },
    async projectTasks (context, project_id) {
        console.log(project_id)
        const response = await axios.get(`/api/tasks/project/${project_id}`)
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

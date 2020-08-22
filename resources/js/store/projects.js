const state = {
    projects: null,
    selectedProject: null
}

const getters = {
    projects: (state) => state.projects,
    selectedProject: (state) => state.selectedProject
}

const mutations = {
    setProjects (state, projects) {
        state.projects = projects
    },
    setSelectedProject(state, selectedProject) {
        state.selectedProject = selectedProject
    }
}

const actions = {
    async allProjects (context) {
        const response = await axios.get('/api/projects/index')
        context.commit('setProjects', response.data)
    },
    async createProject (context, data) {
        const response = await axios.post('/api/projects/store', data)
        context.commit('setProjects', response.data)
    },
    async editProject (context, {projectId, data}) {
        console.log(projectId)
        console.log(data)
        const response = await axios.patch(`/api/projects/update/${projectId}`, data)
        context.commit('setProjects', response.data)
    },
    async delProject (context, projectId) {
        const response = await axios.delete(`/api/projects/destroy/${projectId}`)
        context.commit('setProjects', response.data)
    },
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}

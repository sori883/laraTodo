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
    async selectedProject(context, selectedProject) {
        context.commit('setSelectedProject', selectedProject)
    },
    async delProject (context, projectId) {
        const response = await axios.delete(`/api/projects/destroy/${projectId}`)
        // if (!getters.projects) {
        //     return
        // }

        // if (response.status === 200) {

        // }
    },
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}

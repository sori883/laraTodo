const state = {
    activeSidebar: false
}

const getters = {
    activeSidebar: (state) => state.activeSidebar
}

const mutations = {
    toggleSidebar (state) {
        state.activeSidebar = !state.activeSidebar
    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
}

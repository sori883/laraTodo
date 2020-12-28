const state = {
    sidebarHidden: false
}

const getters = {
    sidebarHidden: (state) => state.sidebarHidden
}

const mutations = {
    toggleSidebar (state) {
        state.sidebarHidden = !state.sidebarHidden
    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
}

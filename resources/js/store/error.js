const state = {
    message: null
}

const getters = {
    message: (state) => state.message
}

const mutations = {
    setmessage(state, message) {
        state.message = {...message}
        console.dir(state)
    },

    deletemessage(state) {
        state.message = null
    },
}

const actions = {}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}

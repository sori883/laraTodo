const state = {
    message: null
}

const getters = {
    message: (state) => {
        if (!state.message) {
            return null
        }

        const messages = []
        Object.values(state.message).map((item) => {
            messages.push(...item)
        })

        return messages
    }
}

const mutations = {
    setmessage(state, message) {
        state.message = message
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

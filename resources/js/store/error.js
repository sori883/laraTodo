const state = {
    message: null
}

const getters = {
    message: (state) => {
        if (!state.message) {
            return null
        }

        // TODO:いい感じに出来るならしたい
        const messages = []
        Object.values(state.message).map((message) => {
            messages.push(...message)
        })

        return messages
    }
}

const mutations = {
    setmessage(state, message) {
        state.message = message
    },

    deletemessages(state) {
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

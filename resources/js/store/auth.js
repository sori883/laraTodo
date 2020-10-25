const state = {
    user: null
}

const getters = {
    isLogin: (state) => !! state.user,
}

const mutations = {
    setUser (state, user) {
        state.user = user
    }
}

const actions = {
    async register (context, data) {
        const response = await axios.post('/api/user/register', data)
        context.commit('setUser', response.data)
    },
    async login (context, data) {
        const response = await axios.post('/api/user/login', data)
        context.commit('setUser', response.data)
    },
    async logout (context) {
        await axios.post('/api/user/logout')
        context.commit('setUser', null)
    },
    async loginUser (context) {
        const response = await axios.get('/api/user')
        const user = response.data || null
        context.commit('setUser', user)
    },
    async passwordConfirm (context, data) {
        await axios.post('/api/password/email', data)
    },
    async passwordReset (context, data) {
        await axios.post('/api/password/update', data)
    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}

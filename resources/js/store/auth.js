const state = {
    user: null
}

const getters = {
    user: (state) => state.user,
    isLogin: (state) => !! state.user,
}

const mutations = {
    setUser (state, user) {
        state.user = user
    }
}

const actions = {
    async register (context, data) {
        await axios.post('/api/user/register', data)
        await context.dispatch('loginUser')
    },
    async login (context, data) {
        await axios.post('/api/user/login', data)
        await context.dispatch('loginUser')
    },
    async logout (context) {
        await axios.post('/api/user/logout')
        context.commit('setUser', null)
    },
    async passwordConfirm (context, data) {
        await axios.post('/api/password/email', data)
    },
    async passwordReset (context, data) {
        await axios.post('/api/password/update', data)
    },
    async loginUser (context) {
        const response = await axios.get('/api/user')
        const user = response.data || null
        context.commit('setUser', user)
    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}

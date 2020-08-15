import Vue from 'vue'
import Vuex from 'vuex'

import auth from './auth'
import error from './error'
import projects from './projects'

Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    auth,
    error,
    projects
  }
})

export default store

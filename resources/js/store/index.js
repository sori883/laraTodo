import Vue from 'vue'
import Vuex from 'vuex'

import auth from './auth'
import error from './error'
import projects from './projects'
import tasks from './tasks'
import visual from './visual'

Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    auth,
    error,
    projects,
    tasks,
    visual
  }
})

export default store

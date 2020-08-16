/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/* eslint no-unused-vars: 0 */

import './bootstrap'
import Vue from 'vue'
import router from './router'
import store from './store'

import App from './App.vue'

const createApp = async () => {
    await store.dispatch('auth/loginUser')

    new Vue({
        el: '#app',
        router,
        store,
        components: {
            App,
        },
        template: '<App />'
    })
}

createApp()

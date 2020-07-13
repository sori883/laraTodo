/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import './bootstrap'
import Vue from 'vue'
import TaskView from './components/TaskView'

/* eslint no-unused-vars: 0 */
const app = new Vue({
    el: '#app',
    components: {
        TaskView,
    }
})

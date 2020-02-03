import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import categories from '../categories/categories'
import posts from '../posts/post'
import subscribers from '../subscribers/subscribers'
import settings from '../settings/setting'
import markdown from '../posts/markdown/markdown'
import user from  '../users/user'

export default new Vuex.Store ({
    modules: {
        categories,
        posts,
        subscribers,
        settings,
        markdown,
        user
    },

    state:{
        loading: false,
        pagination: false,
        paginator: [],
        flashMessage: {
            message: '',
            type: '',
            bag: ''
        },
        flashMessageFlag: false,
    },

    mutations: {
        set_loading(state, status){
            state.loading = status
        },

        set_flashmessage(state, flashMessage) {
            state.flashMessageFlag = true

            state.flashMessage = flashMessage

            setTimeout(() => {
                state.flashMessageFlag = false
            }, 3000)
        },

        set_paginator(state, data) {

            state.pagination = false
            state.paginator = []

            if (data.per_page < data.total) {
                state.pagination = true
                state.paginator = data
            }
        }
    },

    getters: {
        loading: state => {
            return state.loading
        },

        flashMessage: state => {
            return state.flashMessage
        },

        flashMessageFlag: state => {
            return state.flashMessageFlag
        },

        pagination: state => {
            return state.pagination
        },

        paginator: state => {
            return state.paginator
        },
    },

    actions: {

        logout(context) {
            axios.post('/logout')
                 .then( () => {
                     context.commit('reset_auth_user')
                     location.reload()
                 })
        }
    }
})
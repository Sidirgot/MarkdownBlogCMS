import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import categories from '../categories/categories'
import posts from '../posts/post'


export default new Vuex.Store ({
    modules: {
        categories,
        posts,
    },

    state:{
        user: [],
        loading: false,
        paginaion: false,
        paginator: [],
        flashMessage: {
            message: '',
            type: '',
            bag: ''
        },
        flashMessageFlag: false,
    },

    mutations: {
        set_loading: (state, status) => {
            state.loading = status
        },

        set_user: (state, user) => {
            state.user = user
        },

        set_flashmessage(state, flashMessage) {
            state.flashMessageFlag = true

            state.flashMessage = flashMessage

            setTimeout(() => {
                state.flashMessageFlag = false
            }, 3000)
        },

        set_paginator: (state, data) => {
            if (data.per_page > data.total) {
                state.paginaion = true
                state.paginator = data
            }
        }
    },

    getters: {
        loading: state => {
            return state.loading
        },

        user: state => {
            return state.user
        },

        flashMessage: state => {
            return state.flashMessage
        },

        flashMessageFlag: state => {
            return state.flashMessageFlag
        },

        pagination: state => {
            return state.paginaion
        },

        paginator: state => {
            return state.paginator
        },
    },

    actions: {
        fetchUser(context) {
            axios.get('/api/user/')
                 .then( res => {
                     context.commit('set_user', res.data)
                 })
        },
    }
})
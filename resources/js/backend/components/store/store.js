import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import posts from '../posts/post'

export default new Vuex.Store ({
    modules: {
        user: [],
        posts,
    },

    state:{
        loading: false,
        paginaion: false,
        paginator: []
    },

    mutations: {
        set_loading: (state, status) => {
            state.loading = status
        },

        set_user: (state, user) => {
            state.user = user
        }
    },

    getters: {
        loading: state => {
            return state.loading
        },

        user: state => {
            return state.user
        },

        pagination: state => {
            return state.paginaion
        },

        paginator: state => {
            return state.paginator
        }
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
export default {
    namespaced: true,

    state:{
        subscribers: []
    },

    mutations: {
        set_subscribers(state, subscribers) {
            state.subscribers = subscribers
        }
    },

    getters: {
        subscribers: state => {
            return state.subscribers
        }
    },

    actions: {
        fetchSubscribers(context, page_url) {

            page_url = page_url || '/api/subscribers'

            context.commit('set_loading', true, { root: true})

            axios.get(page_url)
                 .then( (response) => {
                     context.commit('set_subscribers', response.data.data)
                     context.commit('set_paginator', response.data, { root: true})
                     context.commit('set_loading', false, { root: true})
                 })
        }
    }
}
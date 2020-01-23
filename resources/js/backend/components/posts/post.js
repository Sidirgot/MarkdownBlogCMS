export default {
    namespaced: true,

    state: {
        posts: [],
        post: []
    },

    mutations: {
        set_posts(state, posts) {
            state.posts = posts
        },

        set_post(state, post) {
            state.post = post
        },

        new_post(state, post) {
            state.posts.unshift(post)
        },

    },

    getters: {
        posts: state => {
            return state.posts
        },

        post: state => {
            return state.post
        },
    },

    actions: {
        fetchPosts(context, page_url) {

            page_url = page_url || '/api/posts'

            context.commit('set_loading', true, { root: true})

            axios.get(page_url)
                 .then(response => {
                    context.commit('set_posts', response.data.data)
                    context.commit('set_paginator', response.data, { root: true })
                    context.commit('set_loading', false, { root: true})
                 })
        },

        fetchPost(context, id) {
            context.commit('set_loading', true, { root: true})

            axios.get('/api/posts/'+ id)
                 .then( response => {
                    context.commit('set_post', response.data)
                    context.commit('set_loading', false, { root: true})
                 })
        },

        createPost(context, post) {
            return new Promise( (resolve, reject) => {
                context.commit('set_loading', true, { root: true})
                 axios.post('/api/posts', post)
                      .then( ( response ) => {
                            context.commit('new_post', response.data)
                            resolve(response)
                            context.commit('set_loading', false, { root: true})
                            context.commit('set_flashmessage',{message: 'Project Created Successfully', type: 'success'}, {root: true})
                        })
                        .catch( (error) => {
                            reject(error)
                            context.commit('set_flashmessage', { bag: error.response.data.errors, type: 'error' }, {root: true})
                            context.commit('set_loading', false, { root: true})
                        })
            })
        },

        changeStatus(context, {post, status}) {
            axios.patch(`/api/action/${status}/${post.id}`)
                 .then( (response) => {
                     context.commit('set_post', response.data)
                     context.commit('set_flashmessage',{message: `Project ${status} Successfully`, type: 'success'}, {root: true})
                 })
        },

        filterPosts(context, term) {
            context.commit('set_loading', true, { root: true})
            axios.get(`/api/search/${term}`)
                 .then( (response) => {
                     context.commit('set_posts', response.data.data)
                     context.commit('set_paginator', response.data, { root: true })
                     context.commit('set_loading', false, { root: true})
                 })
        }
    }
}
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
                 axios.post('/api/posts', post)
                      .then( ( response ) => {
                            context.commit('new_post', response.data)
                            Bus.$emit('flash-message',{text:'Post Created Succefully', type: 'success'})
                            resolve(response)
                        })
                        .catch( (error) => {
                            reject(error)
                            Bus.$emit('flash-message', { text: error.response.data.message.errors, type: 'error' })
                        })
            })
        },

        // changeStatus(status) {
        //     axios.patch(`/oath/post/actions/${status}/`+ this.post.id)
        //         .then(res => {
        //             this.fetchPost()
        //             Bus.$emit('flash-message',{text: 'Post Status Updated', type: 'success'})
        //         })
        // },

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
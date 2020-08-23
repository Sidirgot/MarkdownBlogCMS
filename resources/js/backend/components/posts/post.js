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

        update_post(state, post) {
            var index = state.posts.findIndex(postItem => postItem.id === post.id)
            state.posts.splice(index, 1, post)
            state.post = post
        },

        delete_post(state, post) {
            var index = state.posts.findIndex(postItem => postItem.id === post.id)
            state.posts.splice(index, 1)
        }

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

        async postFormData() {
            return new Promise( (resolve, reject) => {
                axios.get('/api/post/formData')
                     .then((response) => {
                         resolve(response)
                     })
                     .catch(error => {
                        reject(error) 
                     })
            })  
        },

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

        updatePost(context, {id, form}) {
            return new Promise( (resolve, reject) => {
                context.commit('set_loading', true, { root: true})
                 axios.patch(`/api/posts/${id}`, form)
                      .then( ( response ) => {
                            context.commit('update_post', response.data)
                            resolve(response)
                            context.commit('set_loading', false, { root: true})
                            context.commit('set_flashmessage',{message: 'Project Updated Successfully', type: 'success'}, {root: true})
                        })
                        .catch( (error) => {
                            reject(error)
                            context.commit('set_flashmessage', { bag: error.response.data.errors, type: 'error' }, {root: true})
                            context.commit('set_loading', false, { root: true})
                        })
            })
        },

        deletePost(context, post) {
                context.commit('set_loading', true, { root: true})
                axios.delete(`/api/posts/${post.id}`)
                    .then( (response) => {
                        context.commit('delete_post', post)
                        context.commit('set_loading', false, { root: true})
                        context.commit('set_flashmessage', {message: 'Project Deleted Successfully', type: 'success'}, {root: true})
                    })
        },

        changeStatus(context, {post, status}) {
            axios.patch(`/api/action/${status}/${post.id}`)
                 .then( (response) => {
                     context.commit('set_post', response.data)
                     context.commit('set_flashmessage',{message: `Project ${status} Successfully`, type: 'success'}, {root: true})
                 })
        },

        filterPosts(context, payload) {
            
            context.commit('set_loading', true, { root: true})

            axios.get(`/api/post/search`, {params: payload})
                 .then( (response) => {
                     context.commit('set_posts', response.data.data)
                     context.commit('set_paginator', response.data, { root: true })
                     context.commit('set_loading', false, { root: true})
                 })
        }
    }
}
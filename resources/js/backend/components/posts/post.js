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

    },

    getters: {
        posts: state => {
            return state.posts
        },

        post: state => {
            return state.post
        },

        findPost: (state) => (slug) => {
            console.log(slug)
            return state.posts.find(post => post.slug === slug)
        }
    },

    actions: {
        fetchPosts(context, page_url) {

            page_url = page_url || '/oath/posts'

            context.commit('set_loading', true, { root: true})

            axios.get(page_url)
                 .then(res => {
                    context.commit('set_posts', res.data.data)
                    context.commit('set_loading', false, { root: true})
                 })
        },

        fetchPost() {
            axios.get('/oath/posts/'+ this.id)
                 .then( res => {
                     this.post = res.data
                     this.loaded = true
                 })
        },

        // changeStatus(status) {
        //     axios.patch(`/oath/post/actions/${status}/`+ this.post.id)
        //         .then(res => {
        //             this.fetchPost()
        //             Bus.$emit('flash-message',{text: 'Post Status Updated', type: 'success'})
        //         })
        // }
    }
}
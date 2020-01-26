export default {
    namespaced: true,

    state: {
        images: [],
        uploading: false
    },

    mutations: {
        set_images(state, images) {
            state.images = images
        },

        uploading(state, uploading) {
            state.uploading = uploading
        }
    },

    getters: {
        images: state => {
            return state.images
        },

        uploading: state => {
            return state.uploading
        }
    },

    actions: {
        fetchImages(context) {
            context.commit('uploading', true)
            axios.get('/api/markdown/images')
                .then(response => {
                    context.commit('set_images', response.data)
                    context.commit('uploading', false)
                })
        },

        UploadImage(context, form) {
            context.commit('uploading', true)
            axios.post('/api/markdown/upload', form)
                 .then( response => {
                     context.commit('set_images', response.data)
                     context.commit('uploading', false)
                     context.commit('set_flashmessage', {message: 'Image Uploaded Successfully', type: 'success'}, { root: true })
                 })
                 .catch( error => {
                     context.commit('uploading', false)
                     context.commit('set_flashmessage',{bag: error.response.data.errors, type: 'error'}, { root: true })
                 })
        }
    }
}
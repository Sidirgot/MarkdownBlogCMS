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
        },

        deleteImage(state, image) {
            var index = state.images.findIndex(imageItem => imageItem.image === image)
            state.images.splice(index, 1)
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
        },

        deleteImage(context, image) {
            axios.post('/api/markdown/delete', {image: image})
                 .then( response => {
                     context.commit('deleteImage', image)
                 })
        }
    }
}
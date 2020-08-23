export default {
    namespaced: true,

    state: {
        categories: []
    },

    mutations: {
        set_categories(state, categories) {
            state.categories = categories
        },

        new_category(state, category) {
            state.categories.unshift(category)
        },

        update_category(state, category) {
            var index = state.categories.findIndex(categoryItem => categoryItem.id === category.id)
            state.categories.splice(index, 1, category)
        },

        delete_category(state, index) {
            state.categories.splice(index, 1)
        }
    },

    getters: {
        categories: (state) => {
            return state.categories
        }
    },

    actions: {
        fetchCategories(context) {
            context.commit('set_loading', true, { root: true})
            axios.get('/api/categories')
                 .then(response => {
                     context.commit('set_categories', response.data)
                     context.commit('set_loading', false, { root: true})
                 })
        },

        createCategory(context, category) {

            return new Promise( (resolve, reject) => {

                axios.post('/api/categories', category)
                     .then( (response) => {

                        context.commit('new_category', response.data)

                        resolve(response)
                    })
                    .catch(error => {
                        reject(error)
                    })
            })
        },

        updateCategory(context, category) {
            return new Promise( (resolve, reject) => {
                axios.patch(`/api/categories/${category.id}`, category)
                     .then( (response) => {
                        context.commit('update_category', response.data)
                        resolve(response)
                     })
                     .catch( (error) => {
                        reject(error)
                    })
            })
        },

        deleteCategory(context, {index, category}) {
            return new Promise( (resolve, reject) => {
                axios.delete(`/api/categories/${category.id}`)
                    .then((response) => {
                        context.commit('delete_category', index)
                        resolve(response)
                    })
                    .catch( error => {
                        reject(error)
                    })
            })
        },
    }
}
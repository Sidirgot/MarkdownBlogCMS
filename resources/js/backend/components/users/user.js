export default {
    namespaced: true,

    state: {
        user: []
    },

    mutations: {
        set_user(state, user){
            state.user = user
        },

        reset_auth_user(state){
            state.user = []
        },
    },

    getters: {
        user: state => {
            return state.user
        },
    },

    actions: {
        fetchUser(context) {
            axios.get('/api/user/')
                 .then( res => {
                     context.commit('set_user', res.data)
                 })
        },

        updateUser(context, user) {
            return new Promise( (resolve, reject) => {
                axios.patch(`/api/user/${user.id}`, user )
                     .then( response => {
                         context.commit('set_user', response.data)
                         resolve(response)
                    })
                     .catch(error => {
                        reject(error)
                     })
            })
        },

        changeAvatar(context, {user, data}) {
            return new Promise( (resolve, reject) => {
                axios.post(`/api/user/${user.id}`, data)
                    .then( response => {
                        context.commit('set_user', response.data)
                        resolve(response)
                    })
                    .catch(error => {
                        reject(error)
                    })
            })
        },

        deleteAvatar(context, user) {
            return new Promise((resolve, reject) => {
                axios.patch(`/api/reset/avatar/${user.id}`)
                    .then( response => {
                        context.commit('set_user', response.data)
                        resolve(response)
                    })
                    .catch(error => {
                        reject(error)
                    })
            })
        },
    }
}
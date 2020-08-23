export default {
    namespaced: true,

    state: {
        settings: []
    },

    mutations: {
        set_settings(state, settings) {
            state.settings = settings
        },

        new_setting(state, setting) {
            state.settings.unshift(setting)
        },

        update_setting(state, setting) {
            var index = state.settings.findIndex(settingItem => settingItem.id === setting.id)
            state.settings.splice(index, 1, setting)
        },

        delete_setting(state, index) {
            state.settings.splice(index, 1)
        }
    },

    getters: {
        settings: (state) => {
            return state.settings
        }
    },

    actions: {
        fetchSettings(context) {
            context.commit('set_loading', true, { root: true})
            axios.get('/api/settings')
                 .then(response => {
                     context.commit('set_settings', response.data)
                     context.commit('set_loading', false, { root: true})
                 })
        },

        createSetting(context, setting) {

            return new Promise( (resolve, reject) => {

                axios.post('/api/settings', setting)
                     .then( (response) => {
                        context.commit('new_setting', response.data)

                        resolve(response)
                    })
                    .catch( (error) => {
                        reject(error)
                    })
            })
        },

        updateSetting(context, setting) {
            return new Promise( (resolve, reject) => {
                axios.patch(`/api/settings/${setting.id}`, setting)
                     .then( response => {
                        context.commit('update_setting', response.data)
                        resolve(response)
                     })
                     .catch(error => {
                        reject(error)
                    })
            })
        },

        deleteSetting(context, {index, setting}) {
            return new Promise( (resolve, reject) => {
                axios.delete(`/api/settings/${setting.id}`)
                    .then(response => {
                        context.commit('delete_setting', index)
                        resolve(response)
                    })
                    .catch( error => {
                        reject(error)
                    })
            })
        },
    }
}
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

axios.interceptors.response.use((response) => {
    return response

}, ((error) => {
    
    if (error.response.status === 401) {
        location.replace('/login')
    } 

}))
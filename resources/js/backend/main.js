//import '@fortawesome/fontawesome-free/js/all.js'

require('../bootstrap')

import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './routes'
import VModal from 'vue-js-modal'
import store from './components/store/store'
import app from './components/app'

Vue.use(VueRouter)
Vue.use(VModal)

window.Bus = new Vue();

const router = new VueRouter(routes);

const backend = new Vue({
    el: '#backend',
    components: {app},
    router,
    store
});




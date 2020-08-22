//import '@fortawesome/fontawesome-free/js/all.js'

require('../bootstrap')

import Vue from 'vue'

Vue.component('newsletter',require('./components/newsletter.vue').default)
Vue.component('categories',require('./components/categories.vue').default)
Vue.component('search',require('./components/search.vue').default)

const frontend = new Vue({
    el: '.content'
})
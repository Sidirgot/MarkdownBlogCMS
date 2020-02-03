<template>
    <div class="relative">
        <input type="text" v-model="term" class="bg-gray-200 h-12 rounded-l-full focus:outline-none px-4" placeholder="Search....">
        <button @click="search" class="absolute rounded-r-full h-12 bg-teal-600 text-white px-4 hover:opacity-50 focus:outline-none "><i class="fas fa-search"></i></button>
    </div>
</template>

<script>
export default {
    name: 'search',

    data() {
        return {
            term: ''
        }
    },

    methods: {
        search() {
            axios.get(`/search/${this.term}`)
                 .then( response => {
                     window.location.href = '/search/' + this.term;
                 })
        }
    }
}
</script>
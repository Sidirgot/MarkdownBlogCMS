<template>
    <div class="flex">
        <input type="text" v-model="term" @keyup.enter="searchPosts" class="w-full bg-navbar px-4 py-2 rounded text-white" placeholder="Search">
        <button @click="searchPosts" class="btn btn-indigo "><i class="fas fa-search"></i></button>
    </div>
</template>

<script>
export default {
    
    data() {
        return {
            term: '',
        }
    },

    methods: {   
        searchPosts() {
            if (! this.term) {
                return
            }

            this.loading = false

            axios.get('/oath/search/' + this.term)
                 .then( res => {
                    this.$emit('searched', {data: res.data, term: this.term})
                    this.term = ''
                 })
        },
    }
}
</script>
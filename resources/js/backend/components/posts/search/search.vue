<template>
    <div class="flex relative">
        <input type="text" v-model="term" @keyup.enter="searchPosts" class="w-full bg-navbar px-4 py-2 rounded text-white text-sm" placeholder="Search">
        <button @click="searchPosts" class="btn btn-indigo"><i class="fas fa-search"></i></button>
        <button class="clear text-white absolute btn btn-indigo rounded-full" v-show="term" @click="clearPosts">
            <i class="fas fa-times text-sm"></i>
        </button>
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
        searchPosts() {
            if (! this.term) {
                return
            }

            this.$store.dispatch('posts/filterPosts', this.term)
        },

        clearPosts() {
            this.term = ''
            this.$store.dispatch('posts/fetchPosts')
        }
    }
}
</script>

<style scoped>
.clear {
    left: -30px;
}
</style>
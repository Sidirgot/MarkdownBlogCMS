<template>
    <div class="container mx-auto">
        <h1 class="text-xl text-white tracking-wider py-3">Posts</h1>

        <loading></loading>

        <div class="bg-navbar rounded shadow-lg p-4" v-show="! loading">
            <table class="w-full text-white text-center">
                <thead class="bg-main-dark rounded">
                    <th class="py-2">Title</th>
                    <th class="py-2">Actions</th>
                </thead>
                <tbody>
                    <tr class="border-b border-main-dark" v-for="post in posts " :key="post.id">
                        <td class="py-2" v-text="post.title"></td>
                        <td class="py-2">
                            <router-link :to="{name: 'show-post', params:{slug: post.slug}}">
                                <i class="fas fa-eye"></i>
                            </router-link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <paginator></paginator>
        </div>
    </div>
</template>


<script>
import { mapGetters } from 'vuex'
import loading from '../partials/loading'
import paginator from  '../partials/paginator'

export default {
    name: 'posts-index',

    components: { loading, paginator },

    created() {
        this.fetchPosts()
    },

    computed: {
        ...mapGetters('posts', ['posts']),
        ...mapGetters(['loading'])
    },

    methods: {
        fetchPosts() {
            this.$store.dispatch('posts/fetchPosts')
        }
    }
}
</script>
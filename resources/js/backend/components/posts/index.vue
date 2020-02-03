<template>
    <div class="mx-4">
        <div class="flex justify-between flex-wrap items-center mb-4">
            <search></search>

            <router-link :to="{name: 'create-post'}" class="my-3 md:my-0 btn btn-indigo">
                Create New Post<span class="span-icon bg-indigo-800 "><i class="fas fa-plus"></i></span>
            </router-link>
        </div>

        <loading></loading>

        <div class="bg-navbar rounded shadow-lg px-4 pb-6" v-show="! loading">

            <h1 class="text-lg text-white tracking-wider py-4">Posts Table</h1>

            <table class="w-full text-white text-center">
                <thead class="bg-main-dark rounded">
                    <th class="py-2">Title</th>
                </thead>
                <tbody>
                    <tr v-if="posts.length === 0">
                        <td class="py-6">No records in the database.</td>
                    </tr>
                    <tr class="border-b border-main-dark text-sm" v-for="post in posts " :key="post.id">
                        <td class="py-2">
                            <router-link :to="{name: 'show-post', params:{id: post.id}}" class="hover:opacity-50">
                                {{ post.title }}
                            </router-link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <paginator @fetchData="fetchPosts" v-show="! loading"></paginator>
    </div>
</template>


<script>
import { mapGetters } from 'vuex'
import loading from '../partials/loading'
import paginator from  '../partials/paginator'
import search from './search/search'

export default {
    name: 'posts-index',

    components: { loading, paginator, search },

    created() {
        this.fetchPosts()
    },

    computed: {
        ...mapGetters('posts', ['posts']),
        ...mapGetters(['loading'])
    },

    methods: {
        fetchPosts(page_url) {
            this.$store.dispatch('posts/fetchPosts', page_url)
        }
    }
}
</script>
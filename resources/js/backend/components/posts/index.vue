<template>
    <div class="mx-4 tracking-widest">
        
        <PostFilters />

        <loading></loading>

        <div class="bg-navbar rounded shadow-lg px-4 pb-6" v-show="! loading">

            <h1 class="text-lg text-white tracking-wider py-6 flex items-center justify-between">
                Posts Table

                <router-link :to="{name: 'create-post'}" class="my-3 md:my-0 btn btn-blue flex items-center">
                    New Post 
                    <svg width="20" height="20" class="mx-1" viewBox="0 0 20 20">
                        <path  fill="#fff" d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
                    </svg>
                </router-link>
            </h1>

            <table class="w-full text-white text-center">
                <thead class="bg-main-dark rounded leading-10">
                    <th class="py-2 w-20">Title</th>
                    <th class="w-12">Category</th>
                    <th class="w-8">Status</th>
                </thead>
                <tbody>
                    <tr v-if="posts.length === 0">
                        <td class="py-6">No records in the database.</td>
                    </tr>
                    <tr class=" even:bg-main-dark odd:bg-navbar" v-for="post in posts " :key="post.id">
                        <td class="py-2">
                            <router-link :to="{name: 'show-post', params:{id: post.id}}" class="hover:opacity-50 transition-opacity duration-500 text-blue-600">
                                {{ post.title }}
                            </router-link>
                        </td>
                        <td>
                            {{ post.category.name }}
                        </td>
                        <td class="text-center">
                            <span class="h-3 w-3 bg-green-500 rounded-full inline-block" v-if="post.status"></span>
                            <span class="h-3 w-3 bg-red-500 rounded-full inline-block" v-else></span>
                        </td>
                        
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="text-right">
            <paginator @fetchData="fetchPosts" v-show="! loading"></paginator>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import loading from '../partials/loading'
import paginator from  '../partials/paginator'
import PostFilters from './postFilters'

export default {
    name: 'posts-index',

    components: { loading, paginator, PostFilters },

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
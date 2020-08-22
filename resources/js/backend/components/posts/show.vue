<template>
    <div class="container mx-auto my-2">

        <div class="my-3 flex items-center">
            <router-link :to="{name: 'posts'}" class="btn btn-blue flex items-center">
                <svg width="20" height="20" class="mx-1" viewBox="0 0 20 20">
                    <path fill="#fff" d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                </svg>
                Back
            </router-link>
        </div>

        <loading></loading>

        <div class="flex -mx-2" v-show="! loading">
            <div class="w-full md:w-2/3 mb-2 md:mb-0 mx-2">
                <div class="bg-navbar rounded shadow text-white" style="padding:1.25rem 7.5vw 10px">

                    <h1 class="text-xl font-bold text-center my-3" @dblclick="$modal.show('post-edit',{id: post.id,data: post.title, type: 'title'})">{{ post.title }}</h1>

                    <figure class="my-2" @dblclick="$modal.show('post-edit',{id: post.id,data: '/'+post.image, type: 'image'})">
                        <img :src="'/'+ post.image" class="w-full rounded shadow" />
                    </figure>

                    <div v-html="post.parsed" class="markdown_css my-3 text-sm" @dblclick="$modal.show('post-edit',{id: post.id,data: post.content, type: 'content'})">
                    </div>
                </div>

            </div>

            <div class="w-full md:w-1/3 mx-2 text-sm">
                <div class="bg-navbar rounded shadow text-white p-4">

                    <div class="flex justify-between items-center">
                        <div>
                            <button @click="$modal.show('post-destroy',{post})" class="btn btn-red">
                                <svg width="20" height="20" viewBox="0 0 20 20">
                                    <path fill="#fff" d="M17.114,3.923h-4.589V2.427c0-0.252-0.207-0.459-0.46-0.459H7.935c-0.252,0-0.459,0.207-0.459,0.459v1.496h-4.59c-0.252,0-0.459,0.205-0.459,0.459c0,0.252,0.207,0.459,0.459,0.459h1.51v12.732c0,0.252,0.207,0.459,0.459,0.459h10.29c0.254,0,0.459-0.207,0.459-0.459V4.841h1.511c0.252,0,0.459-0.207,0.459-0.459C17.573,4.127,17.366,3.923,17.114,3.923M8.394,2.886h3.214v0.918H8.394V2.886z M14.686,17.114H5.314V4.841h9.372V17.114z M12.525,7.306v7.344c0,0.252-0.207,0.459-0.46,0.459s-0.458-0.207-0.458-0.459V7.306c0-0.254,0.205-0.459,0.458-0.459S12.525,7.051,12.525,7.306M8.394,7.306v7.344c0,0.252-0.207,0.459-0.459,0.459s-0.459-0.207-0.459-0.459V7.306c0-0.254,0.207-0.459,0.459-0.459S8.394,7.051,8.394,7.306"></path>
                                </svg>
                            </button>
                        </div>

                        <div>
                            <button @click="changeStatus('publish')" v-if="!post.status" class="btn btn-blue flex items-center">
                                Publish 
                                <svg width="20" height="20" class="mx-1" viewBox="0 0 20 20">
                                    <path fill="#fff" d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z"></path>
                                </svg>
                            </button>
                            <button @click="changeStatus('unpublish')" v-else class="btn btn-yellow flex items-center">
                                Unpublish 
                                <svg width="20" height="20" class="mx-1" viewBox="0 0 20 20">
                                    <path fill="#fff" d="M17.592,8.936l-6.531-6.534c-0.593-0.631-0.751-0.245-0.751,0.056l0.002,2.999L5.427,9.075H2.491c-0.839,0-0.162,0.901-0.311,0.752l3.683,3.678l-3.081,3.108c-0.17,0.171-0.17,0.449,0,0.62c0.169,0.17,0.448,0.17,0.618,0l3.098-3.093l3.675,3.685c-0.099-0.099,0.773,0.474,0.773-0.296v-2.965l3.601-4.872l2.734-0.005C17.73,9.688,18.326,9.669,17.592,8.936 M3.534,9.904h1.906l4.659,4.66v1.906L3.534,9.904z M10.522,13.717L6.287,9.48l4.325-3.124l3.088,3.124L10.522,13.717z M14.335,8.845l-3.177-3.177V3.762l5.083,5.083H14.335z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="my-2" v-if="post.category">
                        <label class="font-bold">Category</label>
                        <p class="ml-3" @dblclick="$modal.show('post-edit',{id: post.id, data: post.category.id, type: 'category_id'})">{{ post.category.name }}</p>
                    </div>

                    <div class="my-2">
                        <label class="font-bold">Slug</label>
                        <p class="ml-3" @dblclick="$modal.show('post-edit',{id: post.id,data: post.slug, type: 'slug'})">{{ post.slug }}</p>
                    </div>
                </div>
            </div>
        </div>

        <destroy></destroy>
        <edit></edit>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import loading from '../partials/loading'
import destroy from './modals/destroy'
import edit from './modals/edit'

export default {
    name: 'show-post',

    components:{ loading, destroy, edit },

    created() {
        this.$store.dispatch('posts/fetchPost', this.$route.params.id)
    },

    computed: {
        ...mapGetters('posts', ['posts', 'post']),
        ...mapGetters(['loading'])
    },

    methods: {
        changeStatus(status) {
            var payload = {post: this.post, status: status}

            this.$store.dispatch('posts/changeStatus', payload)
        },
    },
}
</script>
<template>
    <div class="container mx-auto my-2">

        <div class="my-3 flex items-center justify-end">
            <router-link :to="{name: 'posts'}" class="btn btn-purple">
                <i class="fas fa-undo"></i>
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
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>

                        <div>
                            <button @click="changeStatus('publish')" v-if="!post.status" class="btn btn-indigo">
                                Publish <span class="span-icon bg-indigo-800 px-2"><i class="fas fa-check"></i></span>
                            </button>
                            <button @click="changeStatus('unpublish')" v-else class="btn btn-teal">
                                Unpublish <span class="span-icon bg-teal-800 px-2"><i class="fas fa-times"></i></span>
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
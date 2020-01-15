<template>
        <div class="" v-show="! loading">
            <!-- <div class="w-full md:w-2/3 mb-2 md:mb-0 md:mr-2">
                <div class="bg-navbar rounded shadow text-white" style="padding:1.25rem 7.5vw 10px">

                    <h1 class="text-xl md:text-3xl lg:text-5xl font-bold text-center my-3" @dblclick="$modal.show('post-edit',{id: post.id,data: post.title, type: 'title'})">{{ post.title }}</h1>

                    <figure class="my-2" @dblclick="$modal.show('post-edit',{id: post.id,data: post.image, type: 'image'})">
                        <img :src="'/' + post.image" class="w-full rounded shadow" />
                    </figure>

                    <div v-html="post.parsed" class="markdown_css my-3" @dblclick="$modal.show('post-edit',{id: post.id,data: post.content, type: 'content'})">
                    </div>
                </div>

            </div>

            <div class="w-full md:w-1/3">
                <div class="bg-navbar rounded shadow text-white p-4">

                    <div class="flex justify-between items-center">
                        <div>
                            <button @click="$modal.show('social-destroy',{post})" class="btn btn-red">
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

                    <div class="my-2">
                        <label class="font-bold">Category</label>
                        <p class="ml-3" @dblclick="$modal.show('post-edit',{id: post.id, data: post.category.id, type: 'category_id'})">{{ post.category.name }}</p>
                    </div>

                    <div class="my-2">
                        <label class="font-bold">Slug</label>
                        <p class="ml-3" @dblclick="$modal.show('post-edit',{id: post.id,data: post.slug, type: 'slug'})">{{ post.slug }}</p>
                    </div>
                </div>
            </div>
         <Delete />
         <Edit /> -->
        </div>
</template>

<script>
import { mapGetters } from 'vuex'
import loading from '../partials/loading'
import Delete from './destroy'
import Edit from './edit'

export default {
    name: 'show-post',

    components:{ loading, Delete,Edit },

    created() {
        if (! this.posts.length) {
            this.$store.dispatch('posts/fetchPosts')
        }

        this.$store.commit('posts/set_post', this.$store.getters['posts/findPost', this.$route.params.slug])
        // this.fetchPost()
    },

    computed: {
        ...mapGetters('posts', ['posts', 'post']),
        ...mapGetters(['loading'])
    },

    methods: {
        fetchPost() {
            this.$store.dispatch('posts/fetchPost')
        },

        changeStatus(status) {

        },
    },
}
</script>
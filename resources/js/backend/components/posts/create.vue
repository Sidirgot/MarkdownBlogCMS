<template>
    <section class="my-2 text-white">
      <div class="flex flex-wrap justify-between items-center mx-2 md:mb-12">

        <div class="flex flex-wrap items-center justify-between text-sm">

          <router-link :to="{name: 'posts'}" class="btn btn-blue flex items-center">
            <svg width="20" height="20" class="mx-1" viewBox="0 0 20 20">
							<path fill="#fff" d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
						</svg>
            Back
          </router-link>

          <h3 class="ml-6 text-lg">Create New Post</h3>     
        </div>

        <div class="my-4 md:my-0 flex items-center">

          <button class="btn btn-purple flex items-center mx-1" @click="$modal.show('category-create')">
            Create Category
            <svg width="20" height="20" class="mx-1" viewBox="0 0 20 20">
                <path  fill="#fff" d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
            </svg>
          </button>

          <button class="btn btn-green flex items-center mx-1" @click="createPost">
            Create Post
            <svg width="20" height="15" class="mx-1" viewBox="0 0 20 20">
              <path fill="#fff" d="M7.197,16.963H7.195c-0.204,0-0.399-0.083-0.544-0.227l-6.039-6.082c-0.3-0.302-0.297-0.788,0.003-1.087
                            C0.919,9.266,1.404,9.269,1.702,9.57l5.495,5.536L18.221,4.083c0.301-0.301,0.787-0.301,1.087,0c0.301,0.3,0.301,0.787,0,1.087
                            L7.741,16.738C7.596,16.882,7.401,16.963,7.197,16.963z"></path>
              </svg>
          </button>
        </div>

      </div>

      <loading></loading>

      <div class="flex flex-wrap md:flex-no-wrap mx-2" v-show="! loading">
        <div class="w-full md:w-1/5 bg-main-dark rounded p-2">

          <div class="mb-4 pb-2">
            <label for="title">Title</label>
            <input type="text" name="title" class="w-full bg-navbar rounded p-2 mx-1 mt-1" placeholder="Title" v-model="title" required>
          </div>

          <div class="my-4 py-3 relative">
            <label for="slug">Slug</label>
            <button class="px-2 py-1 rounded text-sm focus:outline-none btn-blue" @click.prevent="slugstatus = !slugstatus">
              <span v-text="slugstatus ? 'Disable' : 'Enable'">Disable</span>
            </button>
            <input type="text" name="slug" class="w-full bg-navbar rounded p-2 mx-1 mt-1" placeholder="Slug" v-model="slug" v-if="slugstatus">
          </div>

          <div class="my-4 py-2">
            <label for="status" class="block">Status</label>
            <select v-model="status" class="bg-navbar appearance-none p-2 rounded mb-3 mt-1 mx-1" required>
              <option value="0">Draft</option>
              <option value="1">Publish</option>
            </select>
          </div>

          <div class="my-4 py-2">
            <label for="category" class="block">Category</label>
            <select v-model="category_id" class="bg-navbar appearance-none p-2 rounded mb-3 mt-1 mx-1" required>
              <option :value="category.id" v-for="category in categories" :key="category.id" v-text="category.name"></option>
            </select>
          </div>

         <featuredImage @postImage="postImage"></featuredImage>

        </div>

        <div class="w-full md:w-4/5 bg-navbar rounded  p-2 my-2 md:my-0 md:mx-2">

          <Markdown @body="bodyData"></Markdown>

        </div>

      </div>
      <CategoryCreate></CategoryCreate>
    </section>
</template>

<script>
import { mapGetters } from 'vuex'
import Markdown from './markdown/markdownComp'
import CategoryCreate from '../categories/modals/create'
import loading from '../partials/loading'
import featuredImage from './helpers/featuredImage'

export default {
    name: 'create-post',

    components: {Markdown, CategoryCreate, loading, featuredImage},

    data() {
        return {
            title: '',
            body: '',
            slug: '',
            status: '0',
            category_id: 1,
            author: '1',
            watching: '',
            image: '',
            slugstatus: false,
        }
    },

    created() {
      this.$store.dispatch('categories/fetchCategories')
    },

    computed: {
      ...mapGetters('categories', ['categories']),
      ...mapGetters(['loading'])
    },

    methods: {

      bodyData(value) {
        this.body = value
      },

      postImage(image) {
        this.image = image
      },

      createPost() {
        var data = new FormData()

        data.append('image', this.image)
        data.append('title', this.title)
        data.append('content', this.body)
        data.append('category_id', this.category_id)
        data.append('author', this.author)
        data.append('status', this.status)

        if (this.slug) {
          data.append('slug',this.slug)
        }

        this.$store.dispatch('posts/createPost', data)
                   .then( (response) => {
                        this.$router.push({name: 'show-post', params:{id: response.data.id}})
                    })

      }
    }
}
</script>
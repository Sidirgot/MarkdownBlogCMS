<template>
    <section class="my-2 text-white">
      <div class="flex flex-wrap justify-between items-center mx-2 md:mb-12">
        <div class="flex flex-wrap items-center justify-between">
          <h3 class="mr-6 text-lg">Create New Post</h3>

          <router-link :to="{name: 'posts'}" class="btn btn-blue">
            <i class="fas fa-undo"></i>
            Back
          </router-link>
        </div>


        <div class="my-4 md:my-0">
          <button class="btn btn-purple" @click="$modal.show('category-create')">Create Category
            <span class="span-icon bg-purple-800"><i class="fas fa-plus"></i></span>
          </button>
          <button class="btn btn-indigo" @click="createPost">Create Post
            <span class="span-icon bg-indigo-800"><i class="fas fa-check"></i></span>
          </button>
        </div>
      </div>

      <loading></loading>

      <div class="flex flex-wrap md:flex-no-wrap mx-2" v-show="! loading">
        <div class="w-full md:w-1/5 bg-main-dark rounded p-2">

          <div class="my-2">
            <label for="title">Title</label>
            <input type="text" name="title" class="w-full bg-navbar rounded p-2 mx-1 mt-1" placeholder="Title" v-model="title" required>
          </div>

          <div class="my-2 relative">
            <label for="slug">Slug</label>
            <button class="px-2 py-1 rounded text-sm focus:outline-none btn-indigo" @click.prevent="slugstatus = !slugstatus">
              <span v-text="slugstatus ? 'Disable' : 'Enable'">Disable</span>
            </button>
            <input type="text" name="slug" class="w-full bg-navbar rounded p-2 mx-1 mt-1" placeholder="Slug" v-model="slug" v-if="slugstatus">
          </div>

          <div class="my-2">
            <label for="status" class="block">Status</label>
            <select v-model="status" class="bg-navbar appearance-none p-2 rounded mb-3 mt-1 mx-1" required>
              <option value="0">Draft</option>
              <option value="1">Publish</option>
            </select>
          </div>

          <div class="my-2">
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
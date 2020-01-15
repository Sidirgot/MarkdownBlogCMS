<template>
    <section class="my-2 text-white">
      <div class="flex justify-between items-center mx-2">
        <h3 class="my-3 text-xl">Create New Post</h3>

        <div>
          <button class="btn btn-purple" @click="$modal.show('category-create')">Create Category
            <span class="span-icon bg-purple-800"><i class="fas fa-plus"></i></span>
          </button>
          <button class="btn btn-indigo" @click.prevent="createPost">Create Post
            <span class="span-icon bg-indigo-800"><i class="fas fa-check"></i></span>
          </button>
        </div>
      </div>

      <div class="flex flex-wrap md:flex-no-wrap mx-2">
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

          <div class="my-2">
            <label for="Author" class="block">Author</label>
            <select id="Author" v-model="author" class="bg-navbar appearance-none p-2 rounded mb-3 mt-1 mx-1" required>
              <option :value="user.id" v-for="user in users" :key="user.id" v-text="user.name"></option>
            </select>
          </div>

          <div>
            <label for="featured-image" class="border border-navbar p-2 cursor-pointer inline-block">
                <i class="fas fa-cloud-upload-alt mr-2"></i>Featured Image
            </label>
              <input id="featured-image" type="file" accept="image/*" @change="onChange" class="hidden" required>
            <figure>
              <img :src="featured_image" class="my-2">
            </figure>
          </div>

        </div>

        <div class="w-full md:w-4/5 bg-navbar rounded  p-2 my-2 md:my-0 md:mx-2">

          <Markdown @body="bodyData"></Markdown>

        </div>

      </div>
      <CategoryCreate @refresh="fetchCategories" />
    </section>
</template>

<script>
import Markdown from './markdown/markdown'
import CategoryCreate from '../categories/create'

export default {
    components: {Markdown, CategoryCreate},
    data() {
        return {
            categories: {},
            users: {},
            title: '',
            body: '',
            slug: '',
            status: '0',
            category_id: 1,
            author: '1',
            featured_image: '',
            watching: '',
            image: '',
            slugstatus: false,
        }
    },

    created() {
      this.fetchCategories()
      this.fetchUsers()
    },

    methods: {
      fetchCategories() {
        axios.get('/oath/categories')
            .then(res => {
              this.categories = res.data
            })
      },
      fetchUsers() {
        axios.get('/oath/users')
             .then( res => {
               this.users = res.data
             })
      },
      bodyData(value) {
        this.body = value
      },
      onChange(e) {

        if(!e.target.files[0]) {
          return this.featured_image = ''
        }

        this.image = e.target.files[0]

        let reader =  new FileReader

        reader.readAsDataURL(e.target.files[0])

        reader.onload = e => {
          this.featured_image = e.target.result
        }

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

        axios.post('/oath/posts',data)
          .then(res => {
            Bus.$emit('flash-message',{text:'Post Created Succefully', type: 'success'})
            this.$router.push({name: 'show-post',params:{id: res.data.post.id}})
          })
          .catch(e => {
            Bus.$emit('flash-message', { text: e.response.data.message.errors, type: 'error' })
          })
      }
    }
}
</script>
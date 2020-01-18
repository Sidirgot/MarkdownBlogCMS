<template>
    <modal name="post-edit" height="auto" :scrollable="true" :pivotY="0.2" :adaptive="true" @before-open="loadData" @closed="closed">
      <div class="p-2 bg-main-dark text-white" >

        <input type="text" v-model="data" class="bg-navbar p-2 w-full" v-if="(type === 'title' || type === 'slug')">

        <Markdown @body="bodyData" :val="data" v-if="type === 'content'"></Markdown>

        <select v-model="data" v-if="type === 'category_id'" class="bg-navbar p-2 w-full border-none">
          <option v-for="category in categories" :key="category.id" :value="category.id" v-text="category.name" default></option>
        </select>

        <div v-if="type === 'image'">
            <button class="btn btn-blue" @click="$modal.show('markdownimage',{edit: true})">Choose New Image</button>

            <figure>
              <img :src="'/'+ data" class="my-2">
            </figure>
        </div>

        <div class="flex justify-between items-center my-4 -mx-4">
          <button class="flex-1 btn btn-blue mx-4" @click="$modal.hide('post-edit')">Cancel</button>
          <button class="flex-1 btn btn-indigo mx-4" @click="saveChanges">Save Changes</button>
        </div>
      </div>
      <MarkdownImage @editImage="setImage"></MarkdownImage>
    </modal>
</template>

<script>
import Markdown from '../markdown/markdown'
import MarkdownImage from '../markdown/markdownimage'

export default {
  components: {
    Markdown,
    MarkdownImage
  },
  data() {
    return {
      type: '',
      id: '',
      data: '',
      categories: [],
      featured_image: ''
    }
  },
  watch:{
    type() {
      if(this.type === 'category_id') {
        this.fetchCategories()
      }
    }
  },
  methods: {
    onChange(e) {

      if(!e.target.files[0]) {
        return this.data = ''
      }

      this.data = e.target.files[0]

      let reader =  new FileReader

      reader.readAsDataURL(e.target.files[0])

      reader.onload = e => {
        this.featured_image = e.target.result
      }

    },
    bodyData(value) {
      this.data = value
    },
    setImage(image) {
      this.data = image
    },
    loadData(e) {
      this.type = e.params.type
      this.id = e.params.id
      this.data = e.params.data
    },
    saveChanges() {

      var payload =  new FormData()

      payload.append([this.type], this.data)
      payload.append('_method', 'PATCH')

      axios.post('/oath/posts/'+ this.id,payload)
           .then(res => {
             Bus.$emit('flash-message',{text: `${this.type} Updated Successfully`,type: 'success'})
             this.$modal.hide('post-edit')
             this.$emit('refresh')
           })
    },
    fetchCategories() {
        axios.get('/oath/categories')
            .then(res => {
              this.categories = res.data
            })
    },
    closed(e) {
      this.type = ''
      this.id = ''
      this.data = ''
      this.categories = []
      this.featured_image = ''
    }
  }
}
</script>


<style scoped>
.h-modal-textarea {
  height: 35rem;
}

</style>
<template>
    <modal name="post-edit" height="auto" :scrollable="true" :pivotY="0.2" :clickToClose="false" :adaptive="true" @before-open="loadData" @closed="closed">
      <div class="p-2 bg-main-dark text-white" >

        <input type="text" v-model="data" class="bg-navbar p-2 w-full" v-if="(type === 'title' || type === 'slug')">

        <Markdown @body="bodyData" :val="data" v-if="type === 'content'"></Markdown>

        <select v-model="data" v-if="type === 'category_id'" class="bg-navbar p-2 w-full border-none">
          <option v-for="category in categories" :key="category.id" :value="category.id" v-text="category.name" default></option>
        </select>

        <div v-if="type === 'image'">
            <button class="btn btn-blue" @click="$modal.show('markdownimage',{edit: true})">
              <i class="far fa-images"></i>
              Image Gallery
            </button>

            <figure>
              <img :src="data" class="my-2">
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
import Markdown from '../markdown/markdownComp'
import MarkdownImage from '../markdown/markdownimage'
import { mapGetters } from 'vuex'


export default {
    name: 'post-edit',

    components: {
      Markdown,
      MarkdownImage
    },

    data() {
      return {
        type: '',
        id: '',
        data: '',
      }
    },

    watch:{
      type() {
        if(this.type === 'category_id') {
          this.$store.dispatch('categories/fetchCategories')
        }
      }
    },

    computed: {
      ...mapGetters('categories', ['categories'])
    },

    methods: {

      bodyData(value) {
        this.data = value
      },

      setImage(image) {
        this.data = '/'+ image
      },

      loadData(e) {
        this.type = e.params.type
        this.id = e.params.id
        this.data = e.params.data
      },

      saveChanges() {

        if (this.type == "image") {
          this.data = this.data.substr(1)
        }

        var form = {[this.type]: this.data}

        var payload = { id: this.id, form: form}

        this.$store.dispatch('posts/updatePost', payload)
        this.$modal.hide('post-edit')
      },

      closed(e) {
        this.type = ''
        this.id = ''
        this.data = ''
      }
    }
  }
</script>


<style scoped>
.h-modal-textarea {
  height: 35rem;
}

</style>
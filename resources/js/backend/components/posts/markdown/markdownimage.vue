<template>
    <modal name="markdownimage" height="auto" :pivotY="0.2" :adaptive="true" :clickToClose="false" @closed="close">
        <div class="flex justify-between mx-2 py-2">
            <div>
                <label for="featured" class="btn btn-indigo cursor-pointer inline-block text-sm">
                    <i class="fas fa-cloud-upload-alt"></i> Upload
                </label>
                <input id="featured" type="file" accept="image/*" @change="upload" class="hidden" required>

                <button class="btn btn-blue focus:outline-none" @click="setImage">Select</button>
            </div>

            <div>
                <button class="btn btn-red focus:outline-none" @click="deleteImage" v-show="image"><i class="fas fa-trash-alt"></i></button>
                <button class="btn btn-blue focus:outline-none" @click="$modal.hide('markdownimage')"><i class="fas fa-times"></i></button>
            </div>
        </div>

        <div class="bg-navbar min-h-14">
            <div class="lds-ripple" v-show="uploading"><div></div><div></div></div>

            <div class="flex flex-wrap justify-center" v-show="! uploading">
                <img v-for="image in images" :key="image.id" :src="image.image"
                    class="my-2 mx-2 h-40 w-40 object-cover rounded hover:opacity-50 cursor-pointer"
                    :class="{selected: opacity-50}"
                    @click="selectImage(image)">
            </div>
        </div>
        <div class="px-2 py-4">
            <h1 class="break-all text-white" v-text="url"></h1>
        </div>
    </modal>
</template>


<script>
import { mapGetters } from 'vuex'
export default {
    data() {
        return {
            image:'',
            featured: '',
            url: 'You havent selected any image.'
        }
    },

    computed: {
        ...mapGetters('markdown', ['images','uploading'])
    },

    mounted() {
        this.$store.dispatch('markdown/fetchImages')
    },
    methods: {

        selectImage(image) {
            this.url = image.url
            this.image = image.image
        },

        setImage() {
            this.$emit('editImage',this.image)
            this.$modal.hide('markdownimage')
        },

        upload(e) {

            if(!e.target.files[0]) {
                return
            }

            var form = new FormData

            form.append('image',e.target.files[0])

            this.$store.dispatch('markdown/UploadImage', form)
        },

        deleteImage() {
            this.loading = false
            axios.post('/api/post/markdown/image',{image: this.image})
                 .then( res => {
                     Bus.$emit('flash-message',{text:'Image Deleted Successfully',type:'success'})
                     this.getImages()
                     this.loading = true
                 })
        },
        close() {
            this.image = ''
            this.featured = ''
            this.url = ''
        }
    }
}
</script>

<style scoped>
.min-h-14 {
    min-height: 14rem;
}


/** Loading css animation **/
.lds-ripple {
  display: inline-block;
  position: relative;
  left: 16rem;
  top: 4rem;
}
.lds-ripple div {
  position: absolute;
  border: 4px solid #667EEA;
  opacity: 1;
  border-radius: 50%;
  animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
}
.lds-ripple div:nth-child(2) {
  animation-delay: -0.5s;
}
@keyframes lds-ripple {
  0% {
    top: 28px;
    left: 28px;
    width: 0;
    height: 0;
    opacity: 1;
  }
  100% {
    top: -1px;
    left: -1px;
    width: 58px;
    height: 58px;
    opacity: 0;
  }
}
</style>
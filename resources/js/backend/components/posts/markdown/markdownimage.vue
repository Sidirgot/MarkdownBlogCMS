<template>
    <modal name="markdownimage" class="" height="auto" :pivotY="0.2" :adaptive="true" :clickToClose="false" @closed="clearSelection">
        <div class="flex flex-col overflow-y-scroll bg-navbar w-full" style="height: 40rem;">
            <div class="flex justify-between bg-main-dark p-4 w-full">
                <div class="">
                    <label for="featured" class="btn btn-blue cursor-pointer inline-block text-sm">
                        <i class="fas fa-cloud-upload-alt"></i> Upload
                    </label>
                    <input id="featured" type="file" accept="image/*" @change="upload" class="hidden" required>

                    <button class="btn btn-blue focus:outline-none" @click="setImage" v-show="image">Select</button>
                </div>

                <div class="flex items-center">
                    <button class="btn btn-red focus:outline-none mx-1" @click="deleteImage" v-show="image">
                        <svg width="20" height="20" viewBox="0 0 20 20">
							<path fill="#fff" d="M16.588,3.411h-4.466c0.042-0.116,0.074-0.236,0.074-0.366c0-0.606-0.492-1.098-1.099-1.098H8.901c-0.607,0-1.098,0.492-1.098,1.098c0,0.13,0.033,0.25,0.074,0.366H3.41c-0.606,0-1.098,0.492-1.098,1.098c0,0.607,0.492,1.098,1.098,1.098h0.366V16.59c0,0.808,0.655,1.464,1.464,1.464h9.517c0.809,0,1.466-0.656,1.466-1.464V5.607h0.364c0.607,0,1.1-0.491,1.1-1.098C17.688,3.903,17.195,3.411,16.588,3.411z M8.901,2.679h2.196c0.202,0,0.366,0.164,0.366,0.366S11.3,3.411,11.098,3.411H8.901c-0.203,0-0.366-0.164-0.366-0.366S8.699,2.679,8.901,2.679z M15.491,16.59c0,0.405-0.329,0.731-0.733,0.731H5.241c-0.404,0-0.732-0.326-0.732-0.731V5.607h10.983V16.59z M16.588,4.875H3.41c-0.203,0-0.366-0.164-0.366-0.366S3.208,4.143,3.41,4.143h13.178c0.202,0,0.367,0.164,0.367,0.366S16.79,4.875,16.588,4.875zM6.705,14.027h6.589c0.202,0,0.366-0.164,0.366-0.366s-0.164-0.367-0.366-0.367H6.705c-0.203,0-0.366,0.165-0.366,0.367S6.502,14.027,6.705,14.027z M6.705,11.83h6.589c0.202,0,0.366-0.164,0.366-0.365c0-0.203-0.164-0.367-0.366-0.367H6.705c-0.203,0-0.366,0.164-0.366,0.367C6.339,11.666,6.502,11.83,6.705,11.83z M6.705,9.634h6.589c0.202,0,0.366-0.164,0.366-0.366c0-0.202-0.164-0.366-0.366-0.366H6.705c-0.203,0-0.366,0.164-0.366,0.366C6.339,9.47,6.502,9.634,6.705,9.634z"></path>
						</svg>
                    </button>
                    <button class="btn btn-blue focus:outline-none" @click="$modal.hide('markdownimage')">X</button>
                </div>
            </div>

            <div class="flex-1 bg-navbar">
                <div class="lds-ripple" v-show="uploading"><div></div><div></div></div>

                <div class="flex flex-wrap justify-center" v-show="! uploading">
                    <div  v-for="picture in images" :key="picture.id" class="relative">

                        <img :src="'/storage/' + picture.image"
                            class="my-2 mx-2 w-40 object-cover rounded hover:opacity-50 cursor-pointer "
                            @click="selectImage(picture)">

                            <span class="text-green-600 absolute" style="top:5px; right: 10px;" v-show="picture.image === image">
                                <i class="fas fa-check"></i>
                            </span>
                    </div>

                    <div v-if="images.length <= 0" class="text-white mt-8">No images found</div>
                </div>
            </div>

            <div class="px-2 py-4 flex items-center justify-between bg-main-dark">
                <h1 class="break-all text-white" v-text="url"></h1>
                <button class="btn btn-blue" v-show="image" @click="clearSelection">Clear Selection</button>
            </div>
        </div>
    </modal>
</template>


<script>
import { mapGetters } from 'vuex'
export default {
    data() {
        return {
            image:'',
            url: 'You havent selected any image.',
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
                       .then(() => {
                           this.$toasted.success('Image Uploaded Successfully')
                       })
        },

        deleteImage() {
            this.$store.dispatch('markdown/deleteImage', this.image)
                       .then(() => {
                           this.$toasted.success('Image Deleted Successfully')
                       })
        },

        clearSelection() {
            this.image = ''
            this.url = ''
        }
    }
}
</script>

<style scoped>

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
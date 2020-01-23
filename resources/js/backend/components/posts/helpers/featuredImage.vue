<template>
    <div>
        <label for="featured-image" class="border border-navbar p-2 cursor-pointer inline-block">
            <i class="fas fa-cloud-upload-alt mr-2"></i>Featured Image
        </label>
            <input id="featured-image" type="file" accept="image/*" @change="onChange" class="hidden" required>
        <figure>
            <img :src="featured_image" class="my-2">
        </figure>
    </div>
</template>

<script>
export default {
    name: 'featuredImage',

    data() {
        return {
            image: '',
            featured_image: ''
        }
    },

    watch: {
        featured_image() {
            this.$emit('postImage', this.image)
        }
    },

    methods: {
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
    }
}
</script>
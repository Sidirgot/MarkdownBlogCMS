<template>
    <modal name="post-destroy" height="auto" :pivotY="0.2" :adaptive="true" @before-open="loadPost">
         <div class="p-4 bg-main-dark text-white w-full ">
            <h1 class="text-lg border-b border-navbar flex items-center justify-between pb-2">
                Delete post

                <button class="btn btn-blue mx-4" @click="$modal.hide('post-destroy')">
                    X
                </button>
            </h1>

            <p class="py-4 bg-navbar px-4 py-2 my-3">Are you sure you want to delete <span class="text-red-500" v-text="post.title"></span>?</p>

            <div class="flex mt-8">
                
                <button class="flex-1 btn btn-blue mx-4" @click="deletePost">
                    Delete
                </button>
            </div>
        </div>
    </modal>
</template>

<script>
export default {
    name: 'post-destroy',

    data() {
        return {
            post: {}
        }
    },

    methods: {
        deletePost() {
            this.$store.dispatch('posts/deletePost', this.post)
                       .then(() => {

                            this.$modal.hide('post-destroy')
                            this.$toasted.success('Post Deleted Successfully')
                            this.$router.push({name: 'posts'})
                       })
                       .catch(error => {
                           console.log(error)
                       })
        },

        loadPost(e) {
            this.post = e.params.post
        }
    }
}
</script>
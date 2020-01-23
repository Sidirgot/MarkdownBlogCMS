<template>
    <modal name="post-destroy" height="auto" :pivotY="0.2" :adaptive="true" @before-open="loadPost">
         <div class="p-4 bg-main-dark text-white">
            <h1 class="text-lg border-b border-navbar">Delete post Action</h1>

            <p class="py-4">Are you sure you want to delete <span class="text-red-500" v-text="post.title"></span>?</p>

            <div class="flex my-4 -mx-4">
                <button class="flex-1 btn btn-blue mx-4" @click="$modal.hide('post-destroy')">
                    Cancel
                </button>
                <button class="flex-1 btn btn-indigo mx-4" @click="deletePost">
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
            this.$modal.hide('post-destroy')
            this.$router.push({name: 'posts'})
        },

        loadPost(e) {
            this.post = e.params.post
        }
    }
}
</script>
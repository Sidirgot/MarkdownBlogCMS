<template>
    <modal name="social-destroy" height="auto" :pivotY="0.2" :adaptive="true" @before-open="loadPost">
         <div class="p-4 bg-main-dark text-white">
            <h1 class="text-lg border-b border-navbar">Delete post Action</h1>

            <p class="py-4">Are you sure you want to delete <span class="text-red-500" v-text="post.title"></span>?</p>

            <div class="flex my-4 -mx-4">
                <button class="flex-1 btn btn-blue mx-4" @click="$modal.hide('social-destroy')">
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
    data() {
        return {
            post: {}
        }
    },
    methods: {
        deletePost() {
            axios.delete('/oath/posts/'+ this.post.id)
                 .then( res => {
                    Bus.$emit('flash-message',{text: 'Post Deleted Successfully', type: 'success'})
                    this.$emit('refresh')
                    this.$modal.hide('social-destroy')
                    this.$router.go(this.$router.currentRoute)
                 })
        },
        loadPost(e) {
            this.post = e.params.post
        }
    }
}
</script>
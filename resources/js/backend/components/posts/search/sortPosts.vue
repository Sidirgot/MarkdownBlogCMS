<template>
    <div class="flex justify-center items-center">
        <button @click="getDrafts" class="btn btn-teal mx-2">
            Drafts <span class="span-icon bg-teal-800"><i class="far fa-save"></i></span>
        </button>
        <button @click="getPublished" class="btn btn-indigo">
            Published <span class="span-icon bg-indigo-800 mx-2"><i class="fas fa-check"></i></span>
        </button>
    </div>
</template>

<script>
export default {
    methods: {
        getPublished() {
            axios.get('/oath/posts/actions/published')
                .then(res => {
                    this.$emit('searched', {data: res.data, query: 'published'})
                })
        },
        getDrafts() {
            axios.get('/oath/posts/actions/drafts')
                .then(res => {
                    this.$emit('searched', {data: res.data, query: 'drafts'})
                })
        },
    }
}
</script>
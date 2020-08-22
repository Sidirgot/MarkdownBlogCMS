<template>
    <div class="">

        <button class="btn btn-blue text-sm flex items-center my-1" @click="isActive = !isActive">
            <svg width="20" height="20" class="mx-1" viewBox="0 0 20 20">
                <path fill="#fff" d="M6.176,7.241V6.78c0-0.221-0.181-0.402-0.402-0.402c-0.221,0-0.403,0.181-0.403,0.402v0.461C4.79,7.416,4.365,7.955,4.365,8.591c0,0.636,0.424,1.175,1.006,1.35v3.278c0,0.222,0.182,0.402,0.403,0.402c0.222,0,0.402-0.181,0.402-0.402V9.941c0.582-0.175,1.006-0.714,1.006-1.35C7.183,7.955,6.758,7.416,6.176,7.241 M5.774,9.195c-0.332,0-0.604-0.272-0.604-0.604c0-0.332,0.272-0.604,0.604-0.604c0.332,0,0.604,0.272,0.604,0.604C6.377,8.923,6.105,9.195,5.774,9.195 M10.402,10.058V6.78c0-0.221-0.181-0.402-0.402-0.402c-0.222,0-0.402,0.181-0.402,0.402v3.278c-0.582,0.175-1.006,0.714-1.006,1.35c0,0.637,0.424,1.175,1.006,1.351v0.461c0,0.222,0.181,0.402,0.402,0.402c0.221,0,0.402-0.181,0.402-0.402v-0.461c0.582-0.176,1.006-0.714,1.006-1.351C11.408,10.772,10.984,10.233,10.402,10.058M10,12.013c-0.333,0-0.604-0.272-0.604-0.604S9.667,10.805,10,10.805c0.332,0,0.604,0.271,0.604,0.604S10.332,12.013,10,12.013M14.629,8.448V6.78c0-0.221-0.182-0.402-0.403-0.402c-0.221,0-0.402,0.181-0.402,0.402v1.668c-0.581,0.175-1.006,0.714-1.006,1.35c0,0.636,0.425,1.176,1.006,1.351v2.07c0,0.222,0.182,0.402,0.402,0.402c0.222,0,0.403-0.181,0.403-0.402v-2.07c0.581-0.175,1.006-0.715,1.006-1.351C15.635,9.163,15.21,8.624,14.629,8.448 M14.226,10.402c-0.331,0-0.604-0.272-0.604-0.604c0-0.332,0.272-0.604,0.604-0.604c0.332,0,0.604,0.272,0.604,0.604C14.83,10.13,14.558,10.402,14.226,10.402 M17.647,3.962H2.353c-0.221,0-0.402,0.181-0.402,0.402v11.27c0,0.222,0.181,0.402,0.402,0.402h15.295c0.222,0,0.402-0.181,0.402-0.402V4.365C18.05,4.144,17.869,3.962,17.647,3.962 M17.245,15.232H2.755V4.768h14.49V15.232z"></path>
            </svg>
            Filters
        </button>

        <div class="bg-navbar my-2 rounded shadow text-white container mx-auto py-3" v-show="isActive">
            <div class=" flex items-center justify-center">
                <div class="mx-1">
                    <label class="block my-2">Term</label>
                    <input v-model="term" placeholder="Search Term" class="bg-main-dark py-2 px-1 rounded w-64" />
                </div>

                <div class="mx-1">
                    <label class="block my-2">Categories</label>
                    <select class="bg-main-dark py-2 px-1 rounded w-48" v-model="category">
                        <option value="">Select Category</option>

                        <option v-for="category in categories" :key="category.id" :value="category.name" v-text="category.name"></option>
                    </select>
                </div>

                <div class="mx-1">
                    <label class="block my-2">Status</label>
                    <select class="bg-main-dark py-2 px-1 rounded w-48" v-model="status">
                        <option value="">Select Status</option>
                        <option :value="1">Published</option>
                        <option :value="0">Draft</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end mr-6 mt-3">
                <button @click="searchPosts" class="btn btn-blue flex items-center mx-1">
                    Search
                     <svg width="20" height="20" class="mx-1" viewBox="0 0 20 20">
                        <path fill="#fff" d="M18.125,15.804l-4.038-4.037c0.675-1.079,1.012-2.308,1.01-3.534C15.089,4.62,12.199,1.75,8.584,1.75C4.815,1.75,1.982,4.726,2,8.286c0.021,3.577,2.908,6.549,6.578,6.549c1.241,0,2.417-0.347,3.44-0.985l4.032,4.026c0.167,0.166,0.43,0.166,0.596,0l1.479-1.478C18.292,16.234,18.292,15.968,18.125,15.804 M8.578,13.99c-3.198,0-5.716-2.593-5.733-5.71c-0.017-3.084,2.438-5.686,5.74-5.686c3.197,0,5.625,2.493,5.64,5.624C14.242,11.548,11.621,13.99,8.578,13.99 M16.349,16.981l-3.637-3.635c0.131-0.11,0.721-0.695,0.876-0.884l3.642,3.639L16.349,16.981z"></path>
                    </svg>
                </button>
                <button class="btn btn-blue" @click="clearPosts">Clear Search</button>
            </div>

        </div>

    </div>
</template>

<script>
export default {
    name: 'postFilters',

    data() {
        return {
            isActive: false,
            categories: [],
            term: null,
            category: "",
            status: ""
        }
    },

    created() {
        this.fetchFormData()
    },

    methods: {
        fetchFormData() {
            this.$store.dispatch('posts/postFormData')
                   .then((response) => {
                       this.categories = response.data
                   })
                   .catch((error) => {
                       console.error(error)
                   })
        },

        searchPosts() {

            var payload = {}

            if (this.term) {
                payload.term = this.term
            }
            
            if (this.category !== "") {
                payload.category = this.category
            }

            if (this.status !== "") {
                payload.status = this.status
            }

            this.$store.dispatch('posts/filterPosts', payload)
        },

        clearPosts() {
            this.term = null
            this.category = ""
            this.status = ""
            this.$store.dispatch('posts/fetchPosts')
        }
    }
}
</script>
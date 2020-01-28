<template>
     <div class="flex justify-center items-center py-12 border-t border-dark">
        <span v-for="category in categories" :key="category.id" class="text-lg mx-6 tracking-widest hover:text-blue-600">
            <a :href="'/category/'+ category.name" :class="{'text-blue-600': category.name === name}" v-text="category.name"></a>
        </span>
    </div>
</template>

<script>
export default {
    name: 'categories',

    props: {
        name: {
            type: String,
            required: false
        }
    },

    data() {
        return {
            categories: {}
        }
    },

    created() {
        this.fetchCategories()
    },

    methods: {
        fetchCategories() {
            axios.get('/fetch/categories')
                 .then( response => {
                     this.categories = response.data
                 })
        }
    }
}
</script>
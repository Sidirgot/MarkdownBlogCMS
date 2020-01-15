<template>
        <div class="bg-navbar rounded shadow-full p-4 text-white">

            <div class="flex justify-between items-center mx-2">
                <h1 class="text-2xl tracking-wider my-2">Categories ( {{ categories.length }} )</h1>

                <button class="btn btn-indigo" @click="$modal.show('category-create')">
                    Create New <span class="span-icon bg-indigo-800 "><i class="fas fa-plus"></i></span>
                </button>

            </div>
            <table class="table-auto w-full text-center">

                <thead class="bg-main-dark rounded">
                    <th class="p-2">ID</th>
                    <th>Name</th>
                    <th>Color</th>
                    <th>Icon</th>
                    <th>Actions</th>
                </thead>

                <transition-group name="fade" tag="tbody">
                    <tr class="border-b border-main-dark" v-for="( category, index ) in categories" :key="category.id">
                        <td class="p-2">{{ category.id }}</td>
                        <td>{{ category.name }} ( {{ category.post_count }} )</td>
                        <td>
                            <span class="px-2 rounded-full" :style="{'background-color': category.color}"></span>
                        </td>
                        <td>
                            <i :class="category.icon"></i>
                        </td>
                        <td class="inline-flex">
                            <button class="btn btn-yellow mr-2" @click="$modal.show('category-edit', { category })" >
                                <i class="fas fa-pen-square text-sm"></i>
                            </button>

                            <button class="btn btn-red" @click.prevent="deleteRecord(index, category)">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        </td>
                    </tr>
                </transition-group>
            </table>

            <CategoryCreate @refresh="refresh"/>
            <CategoryEdit  @refresh="refresh"/>
        </div>
</template>

<script>
import CategoryCreate from './create'
import CategoryEdit from './edit'

export default {
    components: {
        CategoryEdit,
        CategoryCreate
    },
    data() {
        return {
            categories: {},
        }
    },
    created() {
        this.fetchCategories()
    },
    methods: {
        refresh() {
            this.fetchCategories()
        },
        fetchCategories() {
            axios.get('/oath/categories')
                 .then(res => {
                     this.categories = res.data
                 })
        },
        deleteRecord(index, category) {
            axios.delete('/oath/categories/' + category.id)
                 .then(res => {
                    this.categories.splice(index, 1)
                    Bus.$emit('flash-message', {text: `Category ${category.name} Deleted Successfully`,type: 'success'})
                 })
                 .catch( error => {
                     this.loading = true
                     if (error.response.data.errors) {
                        Bus.$emit('flash-message',{bag: error.response.data.errors ,type:'error'})
                     } else {
                        Bus.$emit('flash-message',{text: error.response.data.message ,type:'error'})
                     }
                 })
        },
    },
}
</script>


<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
}
</style>
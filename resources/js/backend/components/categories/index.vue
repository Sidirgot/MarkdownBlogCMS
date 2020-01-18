<template>
        <div class="container mx-auto my-4">

            <div class="flex justify-between items-center mx-2">
                <h1 class="text-xl tracking-wider my-2 text-white">Categories ( {{ categories.length }} )</h1>

                <button class="btn btn-indigo" @click="$modal.show('category-create')">
                    Create New <span class="span-icon bg-indigo-800 "><i class="fas fa-plus"></i></span>
                </button>
            </div>

            <loading></loading>

            <div class="bg-navbar rounded shadow-full p-4 text-white" v-show="! loading">
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

                                <button class="btn btn-red" @click="$modal.show('category-delete', {category:category, index: index })">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </td>
                        </tr>
                    </transition-group>
                </table>
            </div>

            <create></create>
            <edit></edit>
            <destroy></destroy>
        </div>
</template>

<script>
import { mapGetters } from 'vuex'
import create from './modals/create'
import edit from './modals/edit'
import destroy from './modals/delete'
import loading from '../partials/loading'

export default {
    name: 'categories',

    components: { create, edit, destroy, loading},

    created() {
        this.$store.dispatch('categories/fetchCategories')
    },

    computed: {
        ...mapGetters('categories', ['categories']),
        ...mapGetters(['loading'])
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
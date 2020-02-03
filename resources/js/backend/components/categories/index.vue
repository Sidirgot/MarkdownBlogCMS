<template>
    <div class="mx-4">
        <div class="flex justify-end items-center mx-2 mb-4">
            <button class="btn btn-indigo" @click="$modal.show('category-create')">
                Create New Category <span class="span-icon bg-indigo-800 "><i class="fas fa-plus"></i></span>
            </button>
        </div>

        <loading></loading>

        <div class="bg-navbar rounded shadow-full px-4 pb-6 text-white" v-show="! loading">

            <h1 class="text-lg text-white tracking-wider py-4">Categories Table</h1>

            <table class="table-auto w-full text-center">

                <thead class="bg-main-dark rounded">
                    <th>Name</th>
                    <th class="hidden md:table-cell">Color</th>
                    <th class="hidden md:table-cell">Icon</th>
                    <th>Actions</th>
                </thead>

                <transition-group name="fade" tag="tbody">
                    <tr class="border-b border-main-dark" v-for="( category, index ) in categories" :key="category.id">
                        <td>{{ category.name }} ( {{ category.posts_count }} )</td>
                        <td class="hidden md:table-cell">
                            <span class="px-2 rounded-full" :style="{'background-color': category.color}"></span>
                        </td>
                        <td class="hidden md:table-cell">
                            <i :class="category.icon"></i>
                        </td>
                        <td class="flex flex-wrap md:inline-flex justify-center">
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
<template>
    <div class="mx-4">

        <loading></loading>

        <div class="bg-navbar rounded shadow-full px-4 pb-6 text-white" v-show="! loading">

            <h1 class="text-lg text-white tracking-wider py-4 flex justify-between items-center">
                
                Categories Table

                <button class="btn btn-blue flex  items-center" @click="$modal.show('category-create')">
                    New Category 
                    
                    <svg width="20" height="20" class="mx-1" viewBox="0 0 20 20">
                        <path  fill="#fff" d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
                    </svg>
                </button>
            </h1>

            <table class="table-auto w-full text-center">

                <thead class="bg-main-dark rounded leading-10">
                    <th class="py-2">Name</th>
                    <th>Actions</th>
                </thead>

                <transition-group name="fade" tag="tbody">
                    <tr class="even:bg-main-dark odd:bg-navbar leading-8" v-for="( category, index ) in categories" :key="category.id">

                        <td>{{ category.name }} ( {{ category.posts_count }} )</td>

                        <td class="flex flex-wrap md:inline-flex justify-center py-2">
                            <button class="btn btn-yellow mr-2" @click="$modal.show('category-edit', { category })" >
                                <svg width="15" height="15" viewBox="0 0 20 20">
                                    <path fill="#fff" d="M18.303,4.742l-1.454-1.455c-0.171-0.171-0.475-0.171-0.646,0l-3.061,3.064H2.019c-0.251,0-0.457,0.205-0.457,0.456v9.578c0,0.251,0.206,0.456,0.457,0.456h13.683c0.252,0,0.457-0.205,0.457-0.456V7.533l2.144-2.146C18.481,5.208,18.483,4.917,18.303,4.742 M15.258,15.929H2.476V7.263h9.754L9.695,9.792c-0.057,0.057-0.101,0.13-0.119,0.212L9.18,11.36h-3.98c-0.251,0-0.457,0.205-0.457,0.456c0,0.253,0.205,0.456,0.457,0.456h4.336c0.023,0,0.899,0.02,1.498-0.127c0.312-0.077,0.55-0.137,0.55-0.137c0.08-0.018,0.155-0.059,0.212-0.118l3.463-3.443V15.929z M11.241,11.156l-1.078,0.267l0.267-1.076l6.097-6.091l0.808,0.808L11.241,11.156z"></path>
                                </svg>
                            </button>

                            <button class="btn btn-red" @click="$modal.show('category-delete', {category:category, index: index })">
                                <svg width="15" height="15" viewBox="0 0 20 20">
                                    <path fill="#fff" d="M17.114,3.923h-4.589V2.427c0-0.252-0.207-0.459-0.46-0.459H7.935c-0.252,0-0.459,0.207-0.459,0.459v1.496h-4.59c-0.252,0-0.459,0.205-0.459,0.459c0,0.252,0.207,0.459,0.459,0.459h1.51v12.732c0,0.252,0.207,0.459,0.459,0.459h10.29c0.254,0,0.459-0.207,0.459-0.459V4.841h1.511c0.252,0,0.459-0.207,0.459-0.459C17.573,4.127,17.366,3.923,17.114,3.923M8.394,2.886h3.214v0.918H8.394V2.886z M14.686,17.114H5.314V4.841h9.372V17.114z M12.525,7.306v7.344c0,0.252-0.207,0.459-0.46,0.459s-0.458-0.207-0.458-0.459V7.306c0-0.254,0.205-0.459,0.458-0.459S12.525,7.051,12.525,7.306M8.394,7.306v7.344c0,0.252-0.207,0.459-0.459,0.459s-0.459-0.207-0.459-0.459V7.306c0-0.254,0.207-0.459,0.459-0.459S8.394,7.051,8.394,7.306"></path>
                                </svg>
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
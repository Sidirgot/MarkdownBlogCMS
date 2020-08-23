<template>
    <modal name="category-delete" height="auto" transition="fade" :pivotY="0.2" :adaptive="true" @before-open="beforeOpen" :clickToClose="false">
        <div class="p-4 bg-main-dark text-white w-full">
            <h1 class="text-lg py-2 border-b border-navbar pb-2 flex items-center justify-between">
                Delete Category

                 <button class="btn btn-blue mx-4" @click="$modal.hide('category-delete')">
                    X
                </button>
            </h1>

            <p class="text-sm bg-navbar rounded px-4 py-4">
                Are you certain you want to delete:
                <span class="text-red-600" v-text="category.name"></span>
            </p>

            <div class="flex mt-8">
                <button class="flex-1 btn btn-red mx-4" @click="deleteCategory">
                    Delete
                </button>
            </div>
        </div>
    </modal>
</template>

<script>
export default {
    name: 'category-delete',

    data() {
        return  {
            category: {},
            index: ''
        }
    },

    methods:{
        beforeOpen(event) {
            this.category = event.params.category
            this.index = event.params.index
        },

        deleteCategory() {
            var payload = { category: this.category, index: this.index}
            this.$store.dispatch('categories/deleteCategory', payload )
                       .then( () => {

                           this.$toasted.success('Category Deleted Successfully')

                           this.$modal.hide('category-delete')
                       })

        }
    }
}
</script>
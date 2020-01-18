<template>
    <modal name="category-delete" height="auto" transition="fade" :pivotY="0.2" :adaptive="true" @before-open="beforeOpen" :clickToClose="false">
        <div class="p-4 bg-main-dark text-white">
            <h1 class="text-lg py-2 border-b border-navbar pb-2">Delete Category</h1>

            <p class="text-sm py-4">
                Are you certain you want to delete:
                <span class="text-red-600" v-text="category.name"></span>
            </p>

            <div class="flex my-4 -mx-4">
                <button class="flex-1 btn btn-blue mx-4" @click="$modal.hide('category-delete')">
                    Cancel
                </button>
                <button class="flex-1 btn btn-indigo mx-4" @click="deleteCategory">
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
                           this.$modal.hide('category-delete')
                       })

        }
    }
}
</script>
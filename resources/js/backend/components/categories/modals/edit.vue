<template>
    <modal name="category-edit" height="auto" :pivotY="0.2" @before-open="beforeOpen" :adaptive="true" :clickToClose="false">
        <div class="p-4 bg-main-dark text-white w-full">
            <h1 class="text-lg py-2 border-b border-navbar flex items-center justify-between">
                Update Category
                
                <button class="btn btn-blue mx-4" @click="$modal.hide('category-edit')">
                    X
                </button>
            </h1>

            <div class="my-4">
                <label for="name">Name <span class="text-blue-500 text-sm">(Required)</span></label>
                <input type="text" v-model="category.name" class="bg-navbar rounded p-2 w-full" required>
            </div>

            <div class="flex mt-8">
                <button class="flex-1 btn btn-blue mx-4" @click.prevent="saveChanges">
                    Update
                </button>
            </div>
        </div>
    </modal>
</template>

<script>
export default {
    name: 'category-edit',

    data() {
        return {
            category: {},
        }
    },

    methods: {
        beforeOpen (event) {
             this.category = event.params.category
        },

        saveChanges() {
            this.$store.dispatch('categories/updateCategory', this.category)
                       .then( () => {
                           this.$toasted.success('Category Updated Successfully')
                           this.$modal.hide('category-edit')
                       })
        },
    }
}
</script>

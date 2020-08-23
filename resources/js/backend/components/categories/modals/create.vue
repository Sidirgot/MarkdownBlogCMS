<template>
    <modal name="category-create" height="auto" transition="fade" :pivotY="0.2" :adaptive="true" :clickToClose="false">
        <div class="p-4 bg-main-dark text-white w-full">
            <h1 class="text-lg py-2 border-b border-navbar pb-2 flex items-center justify-between">
                Add a new category

                <button class="btn btn-blue mx-4 text-sm" @click="clearModal">
                    X
                </button>
            </h1>

            <div>

            </div>

            <div class="my-4">
                <label for="name">Name <span class="text-blue-500 text-sm">(Required)</span></label>
                <input type="text" v-model="category.name" class="bg-navbar rounded p-2 w-full" required>
            </div>


            <div class="flex mt-8">
                
                <button class="flex-1 btn btn-blue mx-4" @click.prevent="createCategory">
                    Create
                </button>
            </div>

        </div>
    </modal>
</template>

<script>

export default {
    name: 'category-create',

    data() {
        return {
            category: {
                name: '',
            },
            errors: []
        }
    },

    methods: {
        createCategory() {
            this.$store.dispatch('categories/createCategory', this.category)
                       .then( () => {
                            this.$toasted.success('Category Created Successfully')
                            this.clearModal()
                        })
                        .catch(errors => {
                            
                            this.errors = errors
                        })
        },

        clearModal() {
            this.$modal.hide('category-create')
            this.category = {}
        }
    }
}
</script>
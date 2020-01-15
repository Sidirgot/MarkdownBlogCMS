<template>
    <modal name="category-create" height="auto" transition="fade" :pivotY="0.2" :adaptive="true">
        <div class="p-4 bg-main-dark">
            <h1 class="text-lg py-2 border-b border-navbar pb-2">Add a new category</h1>

            <div class="my-4">
                <label for="name">Name <span class="text-blue-500 text-sm">(Required)</span></label>
                <input type="text" v-model="name" class="bg-navbar rounded p-2 w-full" required>
            </div>


            <div class="my-4">
                <label for="color">Color <span class="text-blue-500 text-sm">(Optional)</span></label>
                <input type="text" v-model="color" class="bg-navbar rounded p-2 w-full" required>
                <span class="block text-purple-600 text-sm my-1">Type the full hex color value including the # ( ex. #f5f5f5 )</span>
            </div>

            <div class="my-4">
                <label for="icon">Icon <span class="text-blue-500 text-sm">(Optional)</span></label>
                <input type="text" v-model="icon" class="bg-navbar rounded p-2 w-full">
                <span class="block text-purple-600 text-sm my-1">Type the full class specied for the specific icon from the font-awesome library. ( ex. fas fa-heart )</span>
            </div>


            <div class="flex my-4 -mx-4">
                <button class="flex-1 btn btn-blue mx-4" @click="$modal.hide('category-create')">
                    Cancel
                </button>
                <button class="flex-1 btn btn-indigo mx-4" @click.prevent="createCategory">
                    Create
                </button>
            </div>

        </div>
    </modal>
</template>

<script>
export default {
    data() {
        return {
            name: '',
            color: '',
            icon: ''
        }
    },
    methods: {
        createCategory() {
            axios.post('/oath/categories', {name:this.name,color:this.color,icon:this.icon})
                 .then(res => {
                    Bus.$emit('flash-message',{text: 'Category Created Successfully',type:'success'})
                    this.$emit('refresh')
                    this.$modal.hide('category-create')
                    this.name = ''
                    this.color = ''
                    this.icon = ''
                 })
                 .catch( error => {
                    Bus.$emit('flash-message',{bag: error.response.data.errors ,type:'error'})
                 })
        }
    }
}
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
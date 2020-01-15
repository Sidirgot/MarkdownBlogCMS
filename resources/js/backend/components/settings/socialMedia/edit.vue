<template>
    <modal name="social-edit" height="auto" :pivotY="0.2" @before-open="beforeOpen" :adaptive="true">
        <div class="p-4 bg-main-dark text-white">
            <h1 class="text-lg py-2 border-b border-navbar">Edit Social Media Account</h1>

            <div class="my-4">
                <label for="name">Name <span class="text-blue-500 text-sm">(Required)</span></label>
                <input type="text" class="p-2 bg-navbar w-full rounded" v-model="account.social_name" required>
            </div>

            <div class="my-4">
                <label for="url">Personal Account Url <span class="text-blue-500 text-sm">(Required)</span></label>
                <input type="text" class="p-2 bg-navbar w-full rounded" v-model="account.personal_account_url" required>
            </div>

            <div class="my-4">
                <label for="url">Social Share Url <span class="text-blue-500 text-sm">(Optional)</span></label>
                <input type="text" class="p-2 bg-navbar w-full rounded" v-model="account.social_share_url">
            </div>

            <div class="my-4">
                <label for="icon">Icon <span class="text-blue-500 text-sm">(Optional)</span></label>
                <input type="text" class="p-2 bg-navbar w-full rounded" v-model="account.social_icon" >
                <span class="block text-purple-600 text-sm my-1">Type the full class specied for the specific icon from the font-awesome library. ( ex. fas fa-heart )</span>
            </div>

            <div class="my-4">
                <label for="icon">Can share <span class="text-blue-500 text-sm">(Optional)</span></label>
                <select class="block bg-navbar rounded appearance-none w-1/3 p-1" v-model="account.sharable">
                    <option value="0">False</option>
                    <option value="1">True</option>
                </select>
                <span class="block text-purple-600 text-sm my-1">Indicates the ability to share on this network </span>
            </div>

            <div class="flex my-4 -mx-4">
                <button class="flex-1 btn btn-blue mx-4" @click="$modal.hide('social-edit')">Cancel</button>
                <button class="flex-1 btn btn-indigo mx-4" @click.prevent="saveChanges">Update</button>
            </div>
        </div>
    </modal>
</template>

<script>
export default {
    data() {
        return {
            account: {},
        }
    },

    methods: {
        beforeOpen (event) {
             this.account = event.params.account
        },
        saveChanges() {
            axios.patch('/oath/socialMedia/'+ this.account.id, this.account)
               .then( res => {
                   if ( res.data.updated === true) {
                        this.$modal.hide('social-edit')
                        this.$emit('refresh')
                        Bus.$emit('flash-message', {text: 'Account Updated Successfully',type: 'success',});
                    }
               })
               .catch(error => {
                   Bus.$emit('flash-message', {bag: error.response.data.errors,type: 'error',});
               })
        },
    }
}
</script>
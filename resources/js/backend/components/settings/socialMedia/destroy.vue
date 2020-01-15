<template>
    <modal name="social-destroy" height="auto" :pivotY="0.2" @before-open="loadAccount" :adaptive="true">
        <div class="p-4 bg-main-dark text-white">
            <h1 class="text-lg border-b border-navbar">Delete User Action</h1>

            <p class="py-4">Are you sure you want to delete <span class="text-red-500" v-text="account.social_name"></span>?</p>
            <div class="flex my-4 -mx-4">
                <button class="flex-1 btn btn-blue mx-4" @click="$modal.hide('social-destroy')">
                    Cancel
                </button>
                <button class="flex-1 btn btn-indigo mx-4" @click="deleteAccount">
                    Delete
                </button>
            </div>
        </div>
    </modal>
</template>

<script>
export default {
    data() {
        return {
            account: {}
        }
    },
    methods: {
        deleteAccount() {
            axios.delete('/oath/socialMedia/'+ this.account.id)
                 .then( res => {
                    if (res.data.deleted === true) {
                        Bus.$emit('flash-message',{text: 'Account Deleted Successfully', type: 'success'})
                        this.$emit('refresh')
                        this.$modal.hide('social-destroy')
                    }
                 })
        },
        loadAccount(e) {
            this.account = e.params.account
        }
    }
}
</script>
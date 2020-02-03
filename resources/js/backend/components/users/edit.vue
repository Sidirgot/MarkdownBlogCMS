<template>
    <modal name="user-edit" height="auto" :pivotY="0.2" @before-open="beforeOpen" :adaptive="true" :clickToClose="false">
        <div class="p-4 bg-main-dark text-white">
            <div class="flex justify-between items-center border-b border-navbar">
                <h1 class="text-lg py-2">Update User Profile</h1>

                <button @click="$modal.hide('user-edit')" class="btn btn-blue">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="flex my-2">
                <button class="btn btn-indigo mx-2" @click="panel = '1'">Profile Details</button>
                <button class="btn btn-indigo mx-2" @click="panel = '2'">Profile Avatar</button>
            </div>

            <div v-show="panel === '1'">
                <div class="my-4">
                    <label for="name">Name <span class="text-blue-500 text-sm">(Optional)</span></label>
                    <input type="text" v-model="user.name" class="bg-navbar rounded p-2 w-full" autocomplete="off">
                </div>

                <div class="my-4">
                    <label for="Email">Email <span class="text-blue-500 text-sm">(Optional)</span></label>
                    <input type="text"  v-model="user.email" class="bg-navbar rounded p-2 w-full" autocomplete="off">
                </div>

                <div class="my-4 relative">
                    <label for="password">Password <span class="text-blue-500 text-sm">(Optional)</span></label>
                    <input type="password" v-model="user.password" class="bg-navbar rounded p-2 w-full" autocomplete="new-password">
                </div>

                <div class="flex my-4 -mx-4">
                    <button class="flex-1 btn btn-blue mx-4" @click="$modal.hide('user-edit')">Cancel</button>
                    <button class="flex-1 btn btn-indigo mx-4" @click="saveChanges">Update</button>
                </div>
            </div>

            <div v-show="panel === '2'">
                <profileAvatar/>
            </div>

        </div>
    </modal>
</template>

<script>
import profileAvatar from './settings/profileAvatar'

export default {
    components: {profileAvatar},

    data() {
        return {
            user: {},
            panel: '1',
        }
    },

    methods: {
        beforeOpen (event) {
             this.user = event.params.user
        },
        saveChanges() {
            this.$store.dispatch('user/updateUser', this.user)
                       .then(() => {
                           this.$modal.hide('user-edit')
                       })
        },
    }
}
</script>

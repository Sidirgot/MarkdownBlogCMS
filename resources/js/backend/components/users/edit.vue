<template>
    <modal name="user-edit" height="auto" :pivotY="0.2" @before-open="beforeOpen" :adaptive="true">
        <div class="p-4 bg-main-dark text-white">
            <h1 class="text-lg py-2 border-b border-navbar ">Update User Profile</h1>

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
                <profileAvatar :user="user" />
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
             if (this.user.avatar !== 'assets/user-avatar.jpg') {
                 this.canDeleteAvatar = true
             }
        },
        saveChanges() {
            axios.patch('/oath/users/'+ this.user.id,  this.user )
               .then( res => {
                    this.$modal.hide('user-edit')
                    Bus.$emit('flash-message', {text: 'User Updated Successfully',type: 'success',});
                    Bus.$emit('refresh-user-info')

               })
               .catch(error => {
                   Bus.$emit('flash-message',{bag: error.response.data.errors, type: 'error'})
               })
        },
    }
}
</script>

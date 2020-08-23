<template>
    <modal name="user-edit" height="auto" :pivotY="0.2" @before-open="beforeOpen" :adaptive="true" :clickToClose="false">
        <div class="p-4 bg-main-dark text-white">
            <div class="flex justify-between items-center border-b border-navbar">
                <h1 class="text-lg py-2">Update User Profile</h1>

                <button @click="$modal.hide('user-edit')" class="btn btn-blue">
                    X
                </button>
            </div>

            <div class="flex justify-center items-center tracking-widest my-2">
                <button class="btn btn-blue mx-2" :class="{'bg-transparent border hover:opacity' : panel === 'profile_details'}" @click="panel = 'profile_details'">Profile Details</button>
                <button class="btn btn-blue mx-2" :class="{'bg-transparent border hover:opacity' : panel === 'profile_avatar'}" @click="panel = 'profile_avatar'">Profile Avatar</button>
            </div>

            <div v-show="panel === 'profile_details'">
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

                <div class="flex mt-8 -mx-4">
                    <button class="flex-1 btn btn-blue mx-4" @click="saveChanges">Update</button>
                </div>
            </div>

            <div v-show="panel === 'profile_avatar'">
                <profileAvatar/>
            </div>

        </div>
    </modal>
</template>

<script>
import profileAvatar from './profileAvatar'

export default {
    components: {profileAvatar},

    data() {
        return {
            user: {},
            panel: "profile_details",
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

<template>
     <div class="my-2 flex items-center justify-between">
        <div class="flex items-center ">
            <figure>
                <img class="w-20 rounded-full mr-4 ml-5" :src="user.avatar" v-show="!avatar" alt="Avatar of Jonathan Reinink">
                <img class="w-20 rounded-full mr-4 ml-5" :src="avatar" v-show="avatar" alt="Avatar of Jonathan Reinink">
            </figure>

            <label for="user_avatar" class="border border-main-dark p-2 cursor-pointer inline-block">
                <span class="btn btn-indigo"><i class="fas fa-cloud-upload-alt"></i></span>
            </label>
            <input id="user_avatar" type="file" accept="image/*" @change="onChange" class="hidden">

            <button class="btn btn-blue" v-show="avatarFile" @click="changeAvatar">Save</button>
        </div>

        <button v-if="user.avatar !== '/assets/user-avatar.jpg'" class="btn btn-red" @click="deleteAvatar"><i class="fas fa-trash"></i></button>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
    name: 'upload-avatar',

    data() {
        return {
            avatar: '',
            avatarFile: '',
        }
    },

    computed: {
        ...mapGetters('user', ['user'])
    },

    methods: {
        onChange(e) {

            if(!e.target.files[0]) {
                return
            }

            this.avatarFile = e.target.files[0]

            let reader =  new FileReader

            reader.readAsDataURL(e.target.files[0])

            reader.onload = e => {
                this.avatar = e.target.result
            }
        },

        changeAvatar() {
            var data = new FormData()

            data.append('avatar', this.avatarFile)
            data.append('_method', 'patch')

            var payload = {user: this.user, data}

            this.$store.dispatch('user/changeAvatar', payload)
                       .then( () => {
                           this.$modal.hide('user-edit')
                       })
        },

        deleteAvatar() {
            this.$store.dispatch('user/deleteAvatar', this.user)
        },
    }
}
</script>
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

            <button class="btn btn-blue" v-show="avatarFile" @click="saveAvatar">Save</button>
        </div>

        <button class="btn btn-red" v-show="canDeleteAvatar" @click="deleteAvatar"><i class="fas fa-trash"></i></button>
    </div>
</template>

<script>
export default {
    name: 'upload-avatar',
    props: ['user'],

    data() {
        return {
            avatar: '',
            avatarFile: '',
            canDeleteAvatar: false
        }
    },

    mounted() {
        if (this.user.avatar !== 'assets/user-avatar.jpg') {
            this.canDeleteAvatar = true
        }
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

        saveAvatar() {
            var data = new FormData()

            data.append('avatar', this.avatarFile)
            data.append('_method', 'patch')

            axios.post('/oath/users/'+ this.user.id, data)
                 .then( res => {
                   this.$modal.hide('user-edit')
                   Bus.$emit('flash-message', {text: 'Avatar Updated Successfully',type: 'success',});
                   Bus.$emit('refresh-user-info')
                 })
                 .catch(error => {
                   Bus.$emit('flash-message',{bag: error.response.data.errors, type: 'error'})
                 })
        },

        deleteAvatar() {
            axios.patch(`/oath/users/reset/${this.user.id}/avatar`)
                 .then( res => {
                   this.$modal.hide('user-edit')
                   Bus.$emit('flash-message', {text: 'Avatar Deleted Successfully',type: 'success',});
                   Bus.$emit('refresh-user-info')
                 })
                 .catch(error => {
                   Bus.$emit('flash-message',{bag: error.response.data.errors, type: 'error'})
                 })
        },
    }
}
</script>
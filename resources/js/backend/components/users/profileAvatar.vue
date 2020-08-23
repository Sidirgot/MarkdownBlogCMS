<template>
     <div class="my-2 flex items-center justify-between flex-wrap my-6">
        <div class="flex items-center ">
            <figure class="w-32">
                <div class="w-32 rounded-full mr-4 ml-5 border h-32 flex items-center justify-center" v-show="!avatar && ! user.avatar">
                    Found No Avatar.
                </div>
                <img class="w-32 rounded-full mr-4 ml-5" :src="'/storage/' + user.avatar" v-show="!avatar && user.avatar" alt="Users Avatar">
                <img class="w-32 rounded-full mr-4 ml-5" :src="avatar" v-show="avatar" alt="Users Avatar">
            </figure>        
        </div>

        <div class="flex items-center">
            
            <div>
                 <label for="user_avatar" class="border border-main-dark p-2 flex">
                    <span class="btn btn-blue cursor-pointer ">
                        <svg width="20" height="20" viewBox="0 0 20 20">
                            <path fill="#fff" d="M8.416,3.943l1.12-1.12v9.031c0,0.257,0.208,0.464,0.464,0.464c0.256,0,0.464-0.207,0.464-0.464V2.823l1.12,1.12c0.182,0.182,0.476,0.182,0.656,0c0.182-0.181,0.182-0.475,0-0.656l-1.744-1.745c-0.018-0.081-0.048-0.16-0.112-0.224C10.279,1.214,10.137,1.177,10,1.194c-0.137-0.017-0.279,0.02-0.384,0.125C9.551,1.384,9.518,1.465,9.499,1.548L7.76,3.288c-0.182,0.181-0.182,0.475,0,0.656C7.941,4.125,8.234,4.125,8.416,3.943z M15.569,6.286h-2.32v0.928h2.32c0.512,0,0.928,0.416,0.928,0.928v8.817c0,0.513-0.416,0.929-0.928,0.929H4.432c-0.513,0-0.928-0.416-0.928-0.929V8.142c0-0.513,0.416-0.928,0.928-0.928h2.32V6.286h-2.32c-1.025,0-1.856,0.831-1.856,1.856v8.817c0,1.025,0.832,1.856,1.856,1.856h11.138c1.024,0,1.855-0.831,1.855-1.856V8.142C17.425,7.117,16.594,6.286,15.569,6.286z"></path>
                        </svg>
                    </span>
                </label>
                <input id="user_avatar" type="file" accept="image/*" @change="onChange" class="hidden">

                <button class="btn btn-blue" v-show="avatarFile" @click="changeAvatar">Save</button>
            </div>

            <button v-if="user.avatar" class="btn btn-red" @click="deleteAvatar">
                <svg width="20" height="20" viewBox="0 0 20 20">
                    <path fill="#fff" d="M16.588,3.411h-4.466c0.042-0.116,0.074-0.236,0.074-0.366c0-0.606-0.492-1.098-1.099-1.098H8.901c-0.607,0-1.098,0.492-1.098,1.098c0,0.13,0.033,0.25,0.074,0.366H3.41c-0.606,0-1.098,0.492-1.098,1.098c0,0.607,0.492,1.098,1.098,1.098h0.366V16.59c0,0.808,0.655,1.464,1.464,1.464h9.517c0.809,0,1.466-0.656,1.466-1.464V5.607h0.364c0.607,0,1.1-0.491,1.1-1.098C17.688,3.903,17.195,3.411,16.588,3.411z M8.901,2.679h2.196c0.202,0,0.366,0.164,0.366,0.366S11.3,3.411,11.098,3.411H8.901c-0.203,0-0.366-0.164-0.366-0.366S8.699,2.679,8.901,2.679z M15.491,16.59c0,0.405-0.329,0.731-0.733,0.731H5.241c-0.404,0-0.732-0.326-0.732-0.731V5.607h10.983V16.59z M16.588,4.875H3.41c-0.203,0-0.366-0.164-0.366-0.366S3.208,4.143,3.41,4.143h13.178c0.202,0,0.367,0.164,0.367,0.366S16.79,4.875,16.588,4.875zM6.705,14.027h6.589c0.202,0,0.366-0.164,0.366-0.366s-0.164-0.367-0.366-0.367H6.705c-0.203,0-0.366,0.165-0.366,0.367S6.502,14.027,6.705,14.027z M6.705,11.83h6.589c0.202,0,0.366-0.164,0.366-0.365c0-0.203-0.164-0.367-0.366-0.367H6.705c-0.203,0-0.366,0.164-0.366,0.367C6.339,11.666,6.502,11.83,6.705,11.83z M6.705,9.634h6.589c0.202,0,0.366-0.164,0.366-0.366c0-0.202-0.164-0.366-0.366-0.366H6.705c-0.203,0-0.366,0.164-0.366,0.366C6.339,9.47,6.502,9.634,6.705,9.634z"></path>
                </svg>
            </button>
        </div>
        
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
                           this.$toasted.success('User Avatar Updated Successfully')
                           this.$modal.hide('user-edit')
                       })
        },

        deleteAvatar() {
            this.$store.dispatch('user/deleteAvatar', this.user)
                        .then(() => {
                            this.$toasted.success('User Avatar Deleted Successfully')
                        })
        },
    }
}
</script>
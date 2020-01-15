<template>
    <div class="flex items-center relative">
        <button class="mr-3 flex items-center hover:opacity-50 focus:outline-none p-2" @click="open = !open">
            <img class="w-12 rounded-full mr-4 ml-5" :src="userAvatar">
            {{ user.name }}
        </button>

        <transition name="dropdown">
            <div class="bg-navbar rounded shadow p-2 absolute dropdown w-48 text-center" v-show="open">
                <button class="w-full p-2 hover:opacity-50 rounded" @click="$modal.show('user-edit', {user}), open = !open"><i class="fas fa-cog"></i> Settings</button>
            </div>
        </transition>

        <button class="bg-main-dark p-5  outline-none" @click="logout">
            <i class="fas fa-sign-out-alt"></i>
        </button>

        <UserEdit />
    </div>
</template>

<script>
import UserEdit from '../users/edit'
import { mapGetters } from 'vuex'

export default {
    components: {
        UserEdit
    },

    data() {
        return {
            open: false,
        }
    },

    created() {
        this.fetchUser()
    },

    computed: {
        userAvatar() {
            return '/'+ this.user.avatar
        },
        ...mapGetters(['user'])
    },

    methods: {
        fetchUser() {
            this.$store.dispatch('fetchUser')
        },

        logout() {
            // axios.post('/logout')
            //      .then( res => location.reload())
        }
    }

}
</script>

<style scoped>
.dropdown {
    top: 4em;
    right: 4em;
}

.dropdown-enter-active,
.dropdown-leave-active  {
    transition: all 0.3s;
}

.dropdown-enter,
.dropdown-leave-to {
    opacity: 0;
}
</style>
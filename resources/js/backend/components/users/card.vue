<template>
    <div class="flex items-center relative">
        <button class="mr-3 flex items-center hover:opacity-50 focus:outline-none" @click="open = !open">
            <img class="w-12 rounded-full mr-4 ml-0 md:ml-5" :src="this.user.avatar">
            {{ user.name }}
        </button>

        <transition name="dropdown">
            <div class="bg-navbar rounded shadow p-2 absolute dropdown w-48 text-center" v-show="open">
                <button class="w-full p-2 hover:opacity-50 rounded" @click="$modal.show('user-edit', {user}), open = !open"><i class="fas fa-cog"></i> Settings</button>
            </div>
        </transition>

        <button class="bg-main-dark p-5 focus:outline-none hover:opacity-50" @click="logout">
            <i class="fas fa-sign-out-alt"></i>
        </button>

        <UserEdit></UserEdit>
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
        ...mapGetters(['user'])
    },

    methods: {
        fetchUser() {
            this.$store.dispatch('fetchUser')
        },
        logout() {
            this.$store.dispatch('logout')
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
    top:2em;
    opacity: 0;
}
</style>
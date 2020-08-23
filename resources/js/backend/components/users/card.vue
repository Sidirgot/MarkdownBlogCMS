<template>
    <div class="flex items-center relative">
        <div>
            <button class="mr-3 flex items-center hover:opacity-50 focus:outline-none" @click="open = !open">
                <img class="w-12 rounded-full mr-4 ml-0 md:ml-5" :src="'/storage/' + user.avatar" v-if="user.avatar">
                {{ user.name }}
            </button>

            <transition name="dropdown">
                <div class="bg-navbar rounded shadow p-2 absolute dropdown w-48 text-center" v-show="open">
                    <button class="w-full p-2 hover:opacity-50 transition-opacity duration-700 rounded focus:outline-none" @click="$modal.show('user-edit', {user}), open = !open"><i class="fas fa-cog"></i> Settings</button>
                </div>
            </transition>
        </div>

        <button class="bg-main-dark p-5 focus:outline-none hover:opacity-50 transition-opacity duration-700" @click="logout">
            <svg width="20" height="20" viewBox="0 0 20 20">
                <path fill="#fff" d="M16.76,7.51l-5.199-5.196c-0.234-0.239-0.633-0.066-0.633,0.261v2.534c-0.267-0.035-0.575-0.063-0.881-0.063c-3.813,0-6.915,3.042-6.915,6.783c0,2.516,1.394,4.729,3.729,5.924c0.367,0.189,0.71-0.266,0.451-0.572c-0.678-0.793-1.008-1.645-1.008-2.602c0-2.348,1.93-4.258,4.303-4.258c0.108,0,0.215,0.003,0.321,0.011v2.634c0,0.326,0.398,0.5,0.633,0.262l5.199-5.193C16.906,7.891,16.906,7.652,16.76,7.51 M11.672,12.068V9.995c0-0.185-0.137-0.341-0.318-0.367c-0.219-0.032-0.49-0.05-0.747-0.05c-2.78,0-5.046,2.241-5.046,5c0,0.557,0.099,1.092,0.292,1.602c-1.261-1.111-1.979-2.656-1.979-4.352c0-3.331,2.77-6.041,6.172-6.041c0.438,0,0.886,0.067,1.184,0.123c0.231,0.043,0.441-0.134,0.441-0.366V3.472l4.301,4.3L11.672,12.068z"></path>
            </svg>
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
        this.$store.dispatch('user/fetchUser')
    },

    computed: {
        ...mapGetters('user', ['user'])
    },

    methods: {
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
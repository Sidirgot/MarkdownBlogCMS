<template>
    <header class=" flex justify-between items-center bg-navbar shadow-lg text-white relative">

        <!-- Desktop Version -->
        <div class="hidden md:flex items-center w-full">
            <div class="ml-2 text-lg uppercase">
                <a href="/">Sidirgot</a>
            </div>

            <div class="ml-20 text-sm">
                <router-link :to="{name:'posts'}" class="px-2 hover:opacity-50">
                    <i class="fas fa-clipboard text-lg"></i>
                    Posts
                </router-link>
                <router-link :to="{name:'categories'}" class="px-2 hover:opacity-50">
                    <i class="fas fa-newspaper text-lg"></i>
                    Categories
                </router-link>
                <router-link :to="{name:'subscribers'}" class="px-2 hover:opacity-50">
                    <i class="fas fa-envelope-open-text text-lg"></i>
                    Subscribers
                </router-link>
            </div>
        </div>
        <!-- End Desktop Version -->

        <!-- Mobile Menu Button -->
        <div class="block md:hidden mx-4">
            <button class="focus:outline-none hover:opacity-50" @click="isOpen = !isOpen">
                <i class="fas fa-bars text-xl"></i>
                Menu
            </button>
        </div>
        <!-- End Mobile Menu Button -->


        <userCard></userCard>

        <!-- Mobile Version -->
        <transition name="dropdown">
            <div class="absolute md:hidden top-4 w-full text-white bg-navbar p-4 shadow-lg z-50" v-show="isOpen">
                <div class="flex flex-col">
                    <router-link :to="{name:'posts'}" @click.native="isOpen = false" class="border-b border-dashed border-white py-2 hover:opacity-50">
                        <i class="fas fa-clipboard text-lg"></i>
                        Posts
                    </router-link>
                    <router-link :to="{name:'categories'}" @click.native="isOpen = false" class="border-b border-dashed border-white py-2 hover:opacity-50">
                        <i class="fas fa-newspaper text-lg"></i>
                        Categories
                    </router-link>
                    <router-link :to="{name:'subscribers'}" @click.native="isOpen = false" class="border-b border-dashed border-white py-2 hover:opacity-50">
                        <i class="fas fa-envelope-open-text text-lg"></i>
                        Subscribers
                    </router-link>
                </div>

            </div>
        </transition>
        <!-- End Mobile Version -->

    </header>
</template>

<script>
import userCard from '../../users/card'

export default {
    name: 'topnav',

    components: { userCard },

    data() {
        return {
            isOpen: false
        }
    },
}
</script>

<style scoped>
.dropdown-enter-active,
.dropdown-leave-active  {
    transition: all 0.3s;
}

.dropdown-enter,
.dropdown-leave-to {
    top: 5em;
    opacity: 0;
}
</style>
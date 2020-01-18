<template>
    <header class="bg-navbar shadow-lg text-white h-16 flex justify-between items-center">
        <div class="ml-2 text-lg uppercase">
            <a href="/">Sidirgot</a>
        </div>

        <div class="mx-4 text-sm">
            <router-link :to="{name:'posts'}">Posts</router-link>
            <router-link :to="{name:'categories'}">Categories</router-link>
            <router-link :to="{name:'subscribers'}">Subscribers</router-link>
            <router-link :to="{name:'settings'}">Settings</router-link>
        </div>

        <div>
            <userCard></userCard>
        </div>
    </header>
</template>

<script>
import userCard from '../../users/card'

export default {
    name: 'topnav',

    components: { userCard }
}
</script>
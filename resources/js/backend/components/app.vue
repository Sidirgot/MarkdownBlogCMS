<template>
    <div>
        <topnav></topnav>

        <div class="container mx-auto mt-4 mb-8">
            <router-view></router-view>
        </div>

    </div>
</template>

<script>
import topnav from './partials/topnav/topnav'

export default {
    name: 'app',

    components: { topnav }
}
</script>
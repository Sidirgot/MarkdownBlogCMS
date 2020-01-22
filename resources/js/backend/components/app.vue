<template>
    <div>
        <topnav></topnav>

        <div class="container mx-auto mt-4 mb-8">
            <router-view></router-view>
        </div>

        <flash-message></flash-message>
    </div>
</template>

<script>
import topnav from './partials/topnav/topnav'
import FlashMessage from './partials/flashmessage'

export default {
    name: 'app',

    components: { topnav, FlashMessage }
}
</script>
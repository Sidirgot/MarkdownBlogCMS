<template>
    <div>
        <topnav></topnav>

        <router-view></router-view>

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
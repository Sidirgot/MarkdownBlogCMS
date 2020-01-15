<template>
<transition name="fade" :appear="true">
    <div class="fixed bottom-0 right-0 m-8" v-if="message">
        <div class="p-6 rounded text-white" style="min-width:240px;"  :class="{
                'bg-red-600': message.type === 'error',
                'bg-green-600': message.type === 'success',
                'bg-yellow-600': message.type === 'info'
            }">
            <div class="flex items-center justify-center">
                {{ message.text }}
            </div>

            <div class="text-white" v-if="message.type === 'error' && message.bag">
                <p class="py-2" v-for="error in message.bag" :key="error.id" v-text="error[0]"></p>
            </div>
        </div>
    </div>
</transition>
</template>

<script>
export default {
    data() {
        return {
            message: {}
        }
    },
    mounted() {
        let timer;
        Bus.$on('flash-message', (message) => {
            clearTimeout(timer)

            this.message = message

            timer = setTimeout(() => {
            this.message = null
            }, 5000)
        })
    }
}
</script>


<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: all .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  transform: translateX(15em);
  opacity: 0;
}
</style>
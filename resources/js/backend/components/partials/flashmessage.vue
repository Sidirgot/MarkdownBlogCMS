<template>
    <transition name="slide" appear>
        <div class="fixed bottom-0 right-0 m-8" v-show="flashMessageFlag">
            <div class="p-6 rounded text-white" style="min-width:240px;"  :class="{
                    'bg-red-600': flashMessage.type === 'error',
                    'bg-green-600': flashMessage.type === 'success',
                    'bg-yellow-600': flashMessage.type === 'info'
                }">
                <div class="flex items-center justify-center">
                    {{ flashMessage.message }}
                </div>

                <div class="text-white" v-if="flashMessage.type === 'error' && flashMessage.bag">
                    <p class="py-2" v-for="error in flashMessage.bag" :key="error.id" v-text="error[0]"></p>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    computed: {
        ...mapGetters(['flashMessage', 'flashMessageFlag'])
    },
}
</script>


<style scoped>
.slide-enter-active, .slide-leave-active {
  transition: all .5s;
}
.slide-enter, .slide-leave-to /* .fade-leave-active below version 2.1.8 */ {
  transform: translateX(15em);
  opacity: 0;
}
</style>
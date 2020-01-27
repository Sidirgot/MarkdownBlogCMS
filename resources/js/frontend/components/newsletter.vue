<template>
    <div class="container mx-auto text-center my-4">
        <p class="tracking-wider my-6 text-xl">
            Stay up to date with the latest news
        </p>

        <div class="text-red-600 p-4 text-center">
            <span v-show="errors.message != '' && errors.email === subscriber.email" v-text="errors.message"></span>
        </div>

        <transition name="fade">
            <div class="flex justify-center" v-show="! subscribed">
                <input v-model="subscriber.email" type="email" class="rounded bg-gray-200 px-4 h-12 text-sm w-1/3" placeholder="Type your email address" required>
                <button class="btn btn-blue h-12 uppercase" @click="subscribe">Subscribe</button>
            </div>
        </transition>

        <transition name="fade">
            <span class="bg-green-600 rounded text-white p-4" v-show="subscribed">
                <span class="h-3 w-3 p-2 bg-green-700 rounded-full text-sm">
                    <i class="fas fa-check"></i>
                </span>
                <span class="bg-green-600 tracking-wider">Thank you for subscribing to our newsletter.</span>
            </span>
        </transition>
    </div>
</template>

<script>
export default {
    name: 'newsletter',

    data() {
        return {
            subscriber: {
                email: ''
            },
            subscribed: false,
            errors: {
                message: '',
                email: ''
            }
        }
    },

    watch: {
        subscribed() {
            if (this.subscribed === true) {
                setTimeout(() => {
                    this.subscribed = false
                    this.subscriber.email = ''
                }, 3000)
            }
        },
    },

    methods: {
        subscribe() {
            if (! this.subscriber.email ) {
                return
            }

            axios.post('/subscriber/new', this.subscriber)
                 .then( response => {
                     if (response.data === 'created') {
                         this.subscribed = true
                     }
                 })
                 .catch( error => {
                     this.errors.message = error.response.data.errors.email[0]
                     this.errors.email = this.subscriber.email
                 })
        }
    }

}
</script>

<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity .8s;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
}
</style>
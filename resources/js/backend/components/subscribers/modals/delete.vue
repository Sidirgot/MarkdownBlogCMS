<template>
    <modal name="subscriber-delete" height="auto" transition="fade" :pivotY="0.2" :adaptive="true" @before-open="beforeOpen" :clickToClose="false">
        <div class="p-4 bg-main-dark text-white w-full">
            <h1 class="text-lg py-2 border-b border-navbar pb-2 flex items-center justify-between">
                Delete Subscriber

                <button class="btn btn-blue mx-4" @click="$modal.hide('subscriber-delete')">
                    X
                </button>
            </h1>

            <p class="text-sm py-2 px-4 rounded bg-navbar">
                Are you certain you want to delete:
                <span class="text-red-600" v-text="subscriber.email"></span>
            </p>

            <div class="flex mt-8">               
                <button class="flex-1 btn btn-red mx-4" @click="deleteSub">
                    Delete
                </button>
            </div>
        </div>
    </modal>
</template>

<script>
export default {
    name: 'subscriber-delete',

    data() {
        return  {
            subscriber: {},
            index: ''
        }
    },

    methods:{
        beforeOpen(event) {
            this.subscriber = event.params.subscriber
            this.index = event.params.index
        },

        deleteSub() {

            var payload = { subscriber: this.subscriber, index: this.index}

            this.$store.dispatch('subscribers/deleteSubscriber', payload )
                       .then( () => {
                           this.$toasted.success('Subscriber Deleted Successfully')
                           this.$modal.hide('subscriber-delete')
                       })

        }
    }
}
</script>
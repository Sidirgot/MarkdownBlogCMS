<template>
    <div class="mx-4">

        <loading></loading>

        <div class="bg-navbar shadow rounded text-white text-sm px-4 pb-6" v-show="! loading">

            <h1 class="text-lg text-white tracking-wider py-4">Subscribers Table</h1>

            <table class="table-auto w-full overflow-auto">
                <thead class="bg-main-dark leading-10">
                    <th class="py-2">Email</th>
                    <th class="py-2">Subcription Date</th>
                    <th>Actions</th>
                </thead>

                <tr class="odd:bg-main-dark even:bg-navbar leading-8 text-center" v-for="(subscriber, index) in subscribers" :key="subscriber.id">
                    <td class="py-2">{{ subscriber.email }}</td>
                    <td class="py-2">{{ subscriber.created_at }}</td>
                    <td>
                        <button class="btn btn-red" @click="$modal.show('subscriber-delete', {subscriber:subscriber, index: index })">
                            <svg width="15" height="15" viewBox="0 0 20 20">
                                <path fill="#fff" d="M17.114,3.923h-4.589V2.427c0-0.252-0.207-0.459-0.46-0.459H7.935c-0.252,0-0.459,0.207-0.459,0.459v1.496h-4.59c-0.252,0-0.459,0.205-0.459,0.459c0,0.252,0.207,0.459,0.459,0.459h1.51v12.732c0,0.252,0.207,0.459,0.459,0.459h10.29c0.254,0,0.459-0.207,0.459-0.459V4.841h1.511c0.252,0,0.459-0.207,0.459-0.459C17.573,4.127,17.366,3.923,17.114,3.923M8.394,2.886h3.214v0.918H8.394V2.886z M14.686,17.114H5.314V4.841h9.372V17.114z M12.525,7.306v7.344c0,0.252-0.207,0.459-0.46,0.459s-0.458-0.207-0.458-0.459V7.306c0-0.254,0.205-0.459,0.458-0.459S12.525,7.051,12.525,7.306M8.394,7.306v7.344c0,0.252-0.207,0.459-0.459,0.459s-0.459-0.207-0.459-0.459V7.306c0-0.254,0.207-0.459,0.459-0.459S8.394,7.051,8.394,7.306"></path>
                            </svg>
                        </button>
                    </td>
                </tr>
            </table>
        </div>

        <div class="text-right">
            <paginator @fetchData="fetchSubscribers" v-show="! loading"></paginator>
        </div>
        
    <destroy />
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import paginator from '../partials/paginator'
import loading from '../partials/loading'
import destroy  from './modals/delete'

export default {
    name: 'subscribers',

    components: { paginator, loading, destroy},

    computed: {
        ...mapGetters('subscribers', ['subscribers']),
        ...mapGetters(['loading'])
    },

    created() {
        this.fetchSubscribers()
    },

    methods: {
        fetchSubscribers(page_url) {
            this.$store.dispatch('subscribers/fetchSubscribers', page_url)
        }
    }
}
</script>
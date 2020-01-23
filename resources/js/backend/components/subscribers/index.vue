<template>
    <div class="mx-4">

        <loading></loading>

        <div class="bg-navbar shadow rounded text-white text-sm px-4 pb-6" v-show="! loading">

            <h1 class="text-lg text-white tracking-wider py-4">Subscribers Table</h1>

            <table class="table-auto w-full overflow-auto">
                <thead class="bg-main-dark">
                    <th class="py-2">Email</th>
                    <th class="py-2">Subcription Date</th>
                </thead>

                <tr class="text-center border-b border-main-dark" v-for="subscriber in subscribers" :key="subscriber.id">
                    <td class="py-2">{{ subscriber.email }}</td>
                    <td class="py-2">{{ subscriber.created_at }}</td>
                </tr>
            </table>
        </div>

        <paginator @fetchData="fetchSubscribers" v-show="! loading"></paginator>

    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import paginator from '../partials/paginator'
import loading from '../partials/loading'

export default {
    name: 'subscribers',

    components: { paginator, loading},

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
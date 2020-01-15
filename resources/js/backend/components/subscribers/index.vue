<template>
    <div class="container mx-auto my-4">

        <div class="bg-navbar shadow rounded mx-2 md:mx-0 text-white p-4">

            <h3 class="text-xl py-2">Subscribers Table</h3>

            <table class="table-auto w-full overflow-auto">
                <thead class="bg-main-dark">
                    <th class="py-4">ID</th>
                    <th class="py-4">Email</th>
                    <th class="py-4">Subcription Date</th>
                </thead>

                <tr class="text-center border-b border-main-dark" v-for="subscriber in subscribers" :key="subscriber.id">
                    <td class="py-4">{{ subscriber.id }}</td>
                    <td class="py-4">{{ subscriber.email }}</td>
                    <td class="py-4">{{ subscriber.created_at }}</td>
                </tr>
            </table>  
        </div>
        
    </div>
</template>

<script>
import Paginator from '../partials/paginator'

export default {
    components: {Paginator},

    data() {
        return {
            subscribers: {},
            paginationData: {}
        }
    },
    created() {
        this.fetchSubscribers()
    },
    methods: {
        
        fetchSubscribers(page_url) {

            page_url = page_url || '/oath/subscribers'
            
            axios.get(page_url)
                .then(res => {
                    this.subscribers = res.data.data
                    this.paginationData = res.data
                })
        },
        refresh() {
            this.fetchSubscribers()
        }
    }
}
</script>
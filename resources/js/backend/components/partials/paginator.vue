<template>
    <div class="my-4 mr-4 text text-sm" v-if="pagination">
        <button class="bg-navbar shadow px-4 py-2 rounded hover:bg-navbar-light focus:outline-none text-white" :class="{'opacity-50 cursor-not-allowed' : !paginator.prev_page_url}"  @click="$emit('fetchData', paginator.prev_page_url)"
            :disabled="!paginator.prev_page_url">
            <i class="fas fa-chevron-left"></i>
        </button>

        <span class="text-sm text-white mx-2">Page {{ paginator.current_page }} out of {{ paginator.last_page }}</span>

        <button class="bg-navbar shadow px-4 py-2 rounded hover:bg-navbar-light focus:outline-none text-white" :class="{'opacity-50 cursor-not-allowed' : !paginator.next_page_url}"  @click="$emit('fetchData', paginator.next_page_url)"
            :disabled="!paginator.next_page_url">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    name: 'pagination',

    computed: {
        ...mapGetters(['pagination', 'paginator'])
    },

}
</script>
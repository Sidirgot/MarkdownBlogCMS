<template>
    <div class="my-4 mr-4 text text-sm" v-if="pagination">
        <button class="bg-navbar shadow px-4 py-2 rounded hover:bg-navbar-light focus:outline-none text-white" :class="{'opacity-50 cursor-not-allowed' : !paginator.prev_page_url}"  @click="$emit('fetchData', paginator.prev_page_url)"
            :disabled="!paginator.prev_page_url">
            <svg width="20" height="20" viewBox="0 0 20 20">
                <path fill="#fff" d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
            </svg>
        </button>

        <span class="text-sm text-white mx-2">Page {{ paginator.current_page }} out of {{ paginator.last_page }} ( Total: {{ paginator.total }} )</span>

        <button class="bg-navbar shadow px-4 py-2 rounded hover:bg-navbar-light focus:outline-none text-white" :class="{'opacity-50 cursor-not-allowed' : !paginator.next_page_url}"  @click="$emit('fetchData', paginator.next_page_url)"
            :disabled="!paginator.next_page_url">
            <svg width="20" height="20" viewBox="0 0 20 20">
                <path fill="#fff" d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
            </svg>
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
<template>
    <modal name="user-show" height="auto" :pivotY="0.2" @before-open="UserData" :adaptive="true">
        <div class="p-4 bg-main-dark text-white">
            <div class="flex justify-between items-center border-b border-navbar pb-2">
                <h1 class="text-lg">User Card</h1>

                <button class="btn btn-blue text-white focus:outline-none" @click="$modal.hide('user-show')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="my-4">
                <label for="name">Name</label>
                <pre class="p-2 bg-navbar w-full rounded" v-text="user.name"></pre>
            </div>

            <div class="my-4">
                <label for="email">Email</label>
                <pre class="p-2 bg-navbar w-full rounded" v-text="user.email"></pre>
            </div>

        </div>
    </modal>
</template>

<script>
export default {
    data() {
        return {
            user: {}
        }
    },
    methods: {
        UserData(e) {
            this.user = e.params.user
        },
    }
}
</script>
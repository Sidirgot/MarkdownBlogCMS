<template>
    <modal name="social-show" height="auto" :pivotY="0.2" @before-open="AccountData" :adaptive="true">
        <div class="p-4 bg-main-dark text-white">
            <div class="flex justify-between items-center border-b border-navbar pb-2">
                <h1 class="text-lg">User Card</h1>

                <button class="btn btn-blue text-white focus:outline-none" @click="$modal.hide('social-show')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="my-4">
                <label for="name">Name</label>
                <pre class="p-2 bg-navbar w-full rounded" v-text="account.social_name"></pre>
            </div>

            <div class="my-4">
                <label for="email">Personal Account Url</label>
                <pre class="p-2 bg-navbar w-full rounded" v-text="account.personal_account_url"></pre>
            </div>

            <div class="my-4">
                <label for="email">Social Share Url</label>
                <pre class="p-2 bg-navbar w-full rounded" v-text="account.social_share_url"></pre>
            </div>

            <div class="my-4">
                <label for="email">Social Icon</label>
                <pre class="p-2 bg-navbar w-full rounded"><i :class="account.social_icon"></i></pre>
            </div>

        </div>
    </modal>
</template>

<script>
export default {
    data() {
        return {
            account: {}
        }
    },
    methods: {
        AccountData(e) {
            this.account = e.params.account
        },
    }
}
</script>
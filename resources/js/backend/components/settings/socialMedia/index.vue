<template>
    <div class="bg-navbar p-3 rounded w-full">
        <div class="flex justify-between items-center my-2">
            <h1 class="text-white py-2">Manage Social Accounts</h1>

            <button class="btn btn-blue" @click="$modal.show('social-create')">Add New Account</button>
        </div>
        <div>
            <table class="table-fixed text-white w-full text-center">
                <thead class="bg-main-dark">
                    <th class="py-2">Name</th>
                    <th>Icon</th>
                    <th>Can Share</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <tr class="border-b border-main-dark" v-for="account in accounts" :key="account.id">
                        <td class="py-3" v-text="account.social_name"></td>
                        <td><i :class="account.social_icon"></i></td>
                        <td>
                            <span v-if="account.sharable" class="bg-green-800 px-2  rounded-full"></span>
                            <span v-else class="bg-purple-800 px-2  rounded-full"></span>
                        </td>
                        <td>
                            <button class="btn btn-indigo" @click="$modal.show('social-show',{ account })"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-yellow" @click="$modal.show('social-edit',{ account })"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-red" @click="$modal.show('social-destroy',{ account })"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <SocialCreate @refresh="refresh" />
        <SocialEdit @refresh="refresh" />
        <SocialDestroy @refresh="refresh" />
        <SocialShow />
    </div>
</template>

<script>
import SocialCreate from './create'
import SocialEdit from './edit'
import SocialDestroy from './destroy'
import SocialShow from './show'

export default {
    components: {
        SocialCreate, SocialEdit, SocialDestroy, SocialShow
    },

    data() {
        return {
            accounts: {}
        }
    },
    created() {
        this.fetchAccounts()
    },
    methods: {
        fetchAccounts() {
            axios.get('/oath/socialMedia')
                 .then( res => {
                     this.accounts = res.data
                 })
        },
        refresh() {
            this.fetchAccounts()
        }
    }
}
</script>
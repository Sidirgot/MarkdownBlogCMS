<template>
    <div class="mx-4">
        <div class="flex justify-end items-center mx-2 mb-4">
            <button class="btn btn-indigo" @click="$modal.show('setting-create')">
                Create New Setting <span class="span-icon bg-indigo-800 "><i class="fas fa-plus"></i></span>
            </button>
        </div>

         <loading></loading>

        <div class="bg-navbar rounded shadow-full px-4 pb-6 text-white" v-show="! loading">

            <h1 class="text-lg text-white tracking-wider py-4">Settings Table</h1>

            <table class="table-fixed w-full text-center text-sm">

                <thead class="bg-main-dark rounded">
                    <th>Type</th>
                    <th>Value</th>
                    <th>Actions</th>
                </thead>

                <transition-group name="fade" tag="tbody">
                    <tr class="border-b border-main-dark" v-for="( setting, index ) in settings" :key="setting.id">
                        <td>{{ setting.type }}</td>
                        <td>{{ checkValueLength(setting.value) }}</td>
                        <td class="flex flex-wrap md:inline-flex">
                            <button class="btn btn-yellow mr-2" @click="$modal.show('setting-edit', { setting })" >
                                <i class="fas fa-pen-square text-sm"></i>
                            </button>

                            <button class="btn btn-red" @click="$modal.show('setting-delete', {setting:setting, index: index })">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        </td>
                    </tr>
                </transition-group>
            </table>
        </div>

        <create></create>
        <edit></edit>
        <destroy></destroy>

    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import create from './modals/create'
import edit from './modals/edit'
import destroy from './modals/delete'
import loading from '../partials/loading'

export default {
    name: 'settings',

    components: { create, edit, destroy, loading},

    created() {
        this.$store.dispatch('settings/fetchSettings')
    },

    computed: {
        ...mapGetters('settings', ['settings']),
        ...mapGetters(['loading']),
    },

    methods: {
        checkValueLength(value) {
            if (value.length >= 50) {
                return value.substring(0, 50) + '...'
            }
            else {
                return value
            }
        }
    }
}
</script>


<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
}
</style>
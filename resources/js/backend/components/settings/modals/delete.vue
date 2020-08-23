<template>
    <modal name="setting-delete" height="auto" transition="fade" :pivotY="0.2" :adaptive="true" @before-open="beforeOpen" :clickToClose="false">
        <div class="p-4 bg-main-dark text-white w-full">
            <h1 class="text-lg py-2 border-b border-navbar pb-2 flex items-center justify-between">
                Delete Setting
                
                <button class="btn btn-blue mx-4" @click="$modal.hide('setting-delete')">
                    X
                </button>
            </h1>

            <p class="text-sm py-2 rounded bg-navbar px-4">
                Are you certain you want to delete:
                <span class="text-red-600" v-text="setting.type"></span>
            </p>

            <div class="flex mt-8">
                <button class="flex-1 btn btn-red mx-4" @click="deleteSetting">
                    Delete
                </button>
            </div>
        </div>
    </modal>
</template>

<script>
export default {
    name: 'setting-delete',

    data() {
        return  {
            setting: {},
            index: ''
        }
    },

    methods:{
        beforeOpen(event) {
            this.setting = event.params.setting
            this.index = event.params.index
        },

        deleteSetting() {

            var payload = { setting: this.setting, index: this.index}

            this.$store.dispatch('settings/deleteSetting', payload )
                       .then( () => {
                           this.$toasted.success('Setting Deleted Successfully')
                           this.$modal.hide('setting-delete')
                       })

        }
    }
}
</script>
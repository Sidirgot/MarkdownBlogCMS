<template>
    <modal name="setting-edit" height="auto" :pivotY="0.2" @before-open="beforeOpen" :adaptive="true" :clickToClose="false">
        <div class="p-4 bg-main-dark text-white">
            <h1 class="text-lg py-2 border-b border-navbar">Update Setting</h1>

            <div class="my-4">
                <label for="type">Type <span class="text-blue-500 text-sm">(Optional)</span></label>
                <input type="text" v-model="setting.type" class="bg-navbar rounded p-2 w-full">
            </div>

            <div class="my-4">
                <label for="value">Value <span class="text-blue-500 text-sm">(Optional)</span></label>
                <textarea type="text" cols="4" rows="4" v-model="setting.value" class="bg-navbar rounded p-2 w-full"></textarea>
            </div>

            <div class="flex my-4 -mx-4">
                <button class="flex-1 btn btn-blue mx-4" @click="$modal.hide('setting-edit')">
                    Cancel
                </button>
                <button class="flex-1 btn btn-indigo mx-4" @click.prevent="saveChanges">
                    Update
                </button>
            </div>
        </div>
    </modal>
</template>

<script>
export default {
    name: 'setting-edit',

    data() {
        return {
            setting: {},
        }
    },

    methods: {
        beforeOpen (event) {
             this.setting = event.params.setting
        },

        saveChanges() {
            this.$store.dispatch('settings/updateSetting', this.setting)
                       .then( () => {
                           this.$modal.hide('setting-edit')
                       })
        },
    }
}
</script>

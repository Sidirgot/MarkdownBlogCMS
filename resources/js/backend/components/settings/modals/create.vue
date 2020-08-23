<template>
    <modal name="setting-create" height="auto" transition="fade" :pivotY="0.2" :adaptive="true" :clickToClose="false">
        <div class="p-4 bg-main-dark text-white w-full">
            <h1 class="text-lg py-2 border-b border-navbar pb-2 flex items-center justify-between">
                Create new Setting

                <button class="btn btn-blue mx-4" @click="clearModal">
                    X
                </button>
            </h1>

            <div class="my-4">
                <label for="type">Type <span class="text-blue-500 text-sm">(Required)</span></label>
                <input type="text" v-model="setting.type" class="bg-navbar rounded p-2 w-full" required>
            </div>

            <div class="my-4">
                <label for="value">Value <span class="text-blue-500 text-sm">(Required)</span></label>
                <textarea type="text" cols="4" rows="4" v-model="setting.value" class="bg-navbar rounded p-2 w-full" required></textarea>
            </div>

            <div class="flex mt-8">
                <button class="flex-1 btn btn-blue mx-4" @click.prevent="createSetting">
                    Create
                </button>
            </div>

        </div>
    </modal>
</template>

<script>
export default {
    name: 'setting-create',

    data() {
        return {
            setting: {
                type: '',
                value: '',
            }
        }
    },

    methods: {
        createSetting() {
            this.$store.dispatch('settings/createSetting', this.setting)
                       .then( () => {
                            this.$toasted.success('Setting Created Sussccessfully')
                            this.clearModal()
                        })
        },

        clearModal() {
            this.$modal.hide('setting-create')
            this.setting = {}
        }
    }
}
</script>
<template>
    <div>
        <modal :show="show" :modalType="modalType" @close="close">
            <div class="modal-header">
                <h4>Bulk upload</h4>
            </div>
            <div class="modal-body">
                <flash-message transitionIn="animated swing"></flash-message>
                <form
                    id="app"
                    @submit="formSubmit"
                    enctype="multipart/form-data"
                    novalidate="true"
                >
                    <label for="tags">CSV upload</label>
                    <input
                        type="file"
                        name="file"
                        class="form-control"
                        v-on:change="onFileChange"
                        v-bind="file"
                        ref="file"
                    >
                    <small>Upload a comma-delimited CSV file or xls/xlsx file formated with two columns - first for NAME, second for DESCRIPTION. Each row represents a company with name and description.</small>
                <div class="modal-footer text-right">
                    <b-button
                        :disabled="this.disabled"
                        variant="success"
                        size="md float-right mb-3"
                        @click="formSubmit()">Upload</b-button>
                    <b-button
                        size="md float-right mb-3"
                        @click="close()">Close</b-button>
                </div>
                </form>
            </div>
        </modal>
    </div>
</template>

<script>
    export default {
        props: ['show', 'modalType'],

        data: function () {
            return {
                allowedExstensions: ["csv", "xls", "xlsx"],
                disabled: true,
                file: [],
            };
        },

        methods: {
            close: function () {
                this.$emit('close')
                this.disable = true
                this.file = []
            },

            onFileChange(e){
                this.file = e.target.files[0];
                if(this.file){
                    var extension = this.allowedExstensions.includes(this.file.name.split('.').pop())
                    this.disabled = (this.file && extension) ? false : true;

                    if(!extension){
                        this.flash('Only csv, xls/xlsx files allowed! Please select another file', 'warning', {
                                timeout: 3000
                        });
                    }
                }
            },

            formSubmit: function () {
                this.$parent._data.loading = true
                let that = this
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let formData = new FormData();
                formData.append('file', this.file);

                api.call('post', '/api/import', formData, config)
                    .then(function (response) {
                        if(response.status == 200) {
                           that.$parent.loadCompanies()
                            // that.$parent.items.push({'id': response.data.company.id, 'name' : response.data.company.name, 'desc' : response.data.company.desc})
                        }
                })
                .catch(function (error) {
                       console.log(error)
                });

                this.close();
            },
        }
    }
</script>


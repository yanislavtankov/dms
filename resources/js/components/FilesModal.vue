<template>
    <div>
        <modal :show="show" :modalType="modalType" @close="close">
            <div class="modal-header">
                <h4>Files</h4>
            </div>
            <div v-if="this.companies" class="modal-body">
                <flash-message transitionIn="animated swing"></flash-message>
                <form
                    id="app"
                    @submit="formSubmit"
                    enctype="multipart/form-data"
                    novalidate="true"
                >

                    <label for="title">Company</label>
                    <b-form-select
                        v-model="company"
                        :options="options"
                    ></b-form-select>
                    <label for="title">File name</label>
                    <input
                        type="text"
                        class="form-control"
                        name="title"
                        v-model="title"
                    >
                    <label for="description">Description</label>
                    <input
                        type="text"
                        class="form-control"
                        name="description"
                        v-model="description"
                    >
                    <label for="tags">File upload</label>
                    <input
                        type="file"
                        name="file"
                        class="form-control"
                        v-on:change="onFileChange"
                        v-bind="file"
                        multiple="multiple"
                        ref="file"
                    >
                    <small>One or multiple doc/docx files only!</small>
                <div class="modal-footer text-right">
                    <b-button
                        :disabled="this.disabled"
                        variant="success"
                        size="md float-right mb-3"
                        @click="formSubmit()">Save</b-button>
                    <b-button
                        size="md float-right mb-3"
                        @click="close()">Close</b-button>
                </div>
                </form>
            </div>
            <div v-else class="modal-body">
                <b-alert show variant="danger">There are no companies created. Please add a company at least.</b-alert>
                <div class="modal-footer text-right">
                    <b-button
                        size="md float-right mb-3"
                        @click="close()">Close</b-button>
                </div>
            </div>
        </modal>
    </div>
</template>

<script>
    export default {
        props: ['show', 'modalType'],

        data: function () {
            return {
                company: null,
                id: 0,
                title: '',
                description: '',
                action: 'new',
                options:[],
                allowedExstensions: ["docx", "doc"],
                companies: false,
                disabled: true,
                file: [],
            };
        },

        watch: {
            'title': 'enableSave',
            'description': 'enableSave',
            'company': 'enableSave'
        },

        mounted() {
            this.loadCompanies()
        },

        methods: {
            close: function () {
                this.$emit('close');
                this.id = 0
                this.company = null
                this.title = ''
                this.description = ''
                this.file = []
            },

            enableSave () {
                this.disabled = !this.validateForm()
            },

            loadCompanies () {
                let currentObj = this
                 api.call('get', '/api/companies')
                .then(function (response) {
                    if(response.status == 200){
                        response.data.companies.forEach((value, index, self) =>
                            currentObj.options.push({'value': response.data.companies[index].id, 'text': response.data.companies[index].name})
                        )
                        currentObj.companies = (typeof currentObj.options !== 'undefined' && currentObj.options.length > 0) ? true : false
                    }
                })
                .catch(function (error) {
                    console.log(error)
                });
            },

            validateForm (){
                if(typeof this.file.name !== 'undefined'){
                    var extension = (typeof this.file.name === 'string') ?  this.allowedExstensions.includes(this.file.name.split('.').pop()) : false
                    return (this.company && this.title != '' && this.description != '' && extension) ? true : false
                } else {
                    return false
                }
            },

            onFileChange(e){
                this.file = e.target.files[0];
                this.validateForm()
            },

            formSubmit: function () {
                this.$parent._data.loading = true
                var fileNum = 0
                let that = this
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let formData = new FormData();
                formData.append('company', this.company);
                formData.append('title', this.title);
                formData.append('description', this.description);
                formData.append('user', auth.user.id);

                for( var i = 0; i < this.$refs.file.files.length; i++ ){
                    let file = this.$refs.file.files[i];

    //   if (!file) {
    //     e.preventDefault();
    //     alert('No file chosen');
    //     return;
    //   }

                    if( this.allowedExstensions.includes( file.name.split('.').pop() ) ){
                        formData.append('files[' + fileNum + ']', file);
                        fileNum++
                    }
                }

                api.call('post', '/api/file', formData, config)
                    .then(function (response) {
                        if(response.status == 200) {
                            that.$parent.loadFiles()
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


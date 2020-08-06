<template>
    <div>
    <file-modal :show="fileModal" @close="fileModal = false" :modalType="'small'"></file-modal>
    <pdf-modal :show="pdfModal" :fileName="fileName" @close="pdfModal = false" :modalType="'big'"></pdf-modal>

    <div class="row">
        <div class="col-sm">
            <b-form-select
                class="float-left"
                v-model="company"
                :options="options"
            ></b-form-select>
        </div>
        <div class="col-sm">
            <b-button size="sm float-right mb-3"  @click="fileModal = true">Upload a new file</b-button>
        </div>
    </div>

    <b-table
        striped
        responsive
        :items = "items"
        :fields = "fields"
        :busy = "loading"
    >
        <template v-slot:table-busy>
            <div class="text-center text-danger my-2">
                <b-spinner class="align-middle"></b-spinner>
                <strong>Loading...</strong>
            </div>
        </template>
        <template v-slot:cell(actions)="actions">
            <b-button-group class="btn-group mr-2">
                <b-button class="btn btn-sm" size="sm" variant="secondary" @click = "pdfModal = true; fileName = getFile(actions.item.id)">View</b-button>
                <b-button class="btn btn-sm" size="sm" variant="danger" @click = "fileDelete(actions.item.id)">Delete</b-button>
            </b-button-group>
        </template>
    </b-table>
    </div>

</template>

<script>
    export default {
        data() {
            return {
            company: null,
            options:[],
            loading: true,
            fileModal: false,
            pdfModal: false,
            fileName: '',
            companies: [],
            fields: [
                {
                    key: 'name',
                    label: 'Company',
                    sortable: true
                },
                {
                    key: 'title',
                    label: 'File name',
                    sortable: true
                },
                {
                    key: 'description',
                    label: 'Description'
                },
                {   key: 'actions',
                    label: 'Actions'
                }
            ],
            items: []
            }
        },

        watch: {
            company : function () {
                this.loadFiles(this.company)
            }
        },

        mounted() {
            this.loadCompanies()
            this.loadFiles()
        },

        methods: {
            loadFiles ( id = 0) {
                let currentObj = this
                api.call('get', '/api/files/' + id)
                .then(function (response) {
                    if(response.status == 200){
                        currentObj.items = response.data.files
                        currentObj.loading = false
                    }
                })
                .catch(function (error) {
                    console.log(error)
                });
            },

            getFile ( file = null) {
                let that = this
                api.call('get','/api/file/'+file)
                .then(function (response) {
                    if(response.status == 200){
                        that.fileName = response.data.fileName
                    }
                })
                .catch(function (error) {
                    console.log(error)
                });
            },

            loadCompanies () {
                let currentObj = this
                 api.call('get', '/api/companies')
                .then(function (response) {
                    if(response.status == 200){
                        var filesByCompany = []
                        const unique = (value, index, self) => {
                            return self.indexOf(value) === index
                        }
                        currentObj.items.forEach((value, index, self) => {
                            filesByCompany.push(value.cid)
                        })
                        filesByCompany = filesByCompany.filter(unique)

                        currentObj.options.push({'value': 0, 'text': 'All files'})
                        response.data.companies.forEach((value, index, self) =>
                            {
                                if (filesByCompany.includes(response.data.companies[index].id)) {
                                    currentObj.options.push({'value': response.data.companies[index].id, 'text': response.data.companies[index].name})
                                }
                           }
                        )
                        currentObj.company = 0
                        // currentObj.companies = (typeof currentObj.options !== 'undefined' && currentObj.options.length > 0) ? true : false
                    }
                })
                .catch(function (error) {
                    console.log(error)
                });
            },

            fileDelete ( id = null) {
                let that = this
                const options = {title: 'Confirm delete?', cancelLabel: 'No', size: 'sm'}
                this.$dialogs.confirm('Are you sure you want to delete the selected file!', options)
                .then(res => {
                    if(res.ok === true) {
                        that.loading = true
                        api.call('delete', '/api/file/' + id)
                            .then(function (response) {
                                if(response.status == 200) {
                                    that.loadFiles()
                                    // that.$parent.items.push({'id': response.data.company.id, 'name' : response.data.company.name, 'desc' : response.data.company.desc})
                                }
                        })
                        .catch(function (error) {
                                console.log(error)
                        });
                    }
                })
            }

        }
    }
</script>

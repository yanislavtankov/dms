<template>
<div>
    <company-modal :companyData="companyData" :show="companiesModal" @close="companiesModal = false"></company-modal>
    <import-modal :show="importModal" @close="importModal = false"></import-modal>
    <b-button size="sm float-right mb-3"  @click="companiesModal = true; companyData=''">Add a new company</b-button>
    <b-button size="sm float-right mb-3 mr-3"  @click="importModal = true">Upload CSV file</b-button>
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
        <template v-slot:cell(tags)="data">
            <b-button-group size="sm">
                <div v-for="tTag in data.item.tags">
                    <b-button class="btn mr-2" size="sm" variant="outline-info" @click = "loadCompanies(tTag)">{{ tTag }}</b-button>
                </div>
                <b-button v-if="showAll" class="btn mr-2" size="sm" variant="outline-success" @click = "loadCompanies()">Show all</b-button>
            </b-button-group>
        </template>
        <template v-slot:cell(actions)="actions">
            <b-button-group class="btn-group mr-2">
                <b-button class="btn btn-sm" size="sm" variant="primary" @click = "companiesModal = true; companyData = actions.item">Edit</b-button>
                <b-button class="btn btn-sm" size="sm" variant="danger" @click = "companyDelete(actions.item.id)">Delete</b-button>
            </b-button-group>
        </template>
    </b-table>
</div>
</template>

<script>
export default {
    data() {
        return {
        loading: true,
        companiesModal: false,
        importModal: false,
        companyData: [],
        fields: [
            {
                key: 'name',
                label: 'Company name',
                sortable: true
            },
            {
                key: 'desc',
                label: 'Description'
            },
            {   key: 'tags',
                label: 'Tags'
            },
            {   key: 'actions',
                label: 'Actions'
            }
        ],
        items: []
        }
    },

    mounted() {
        this.loadCompanies()
    },

    methods: {
        loadCompanies ( request = null ) {
            this.showAll = (request) ?  true : false
            let currentObj = this
            request = (request) ? {params: {tag: request}} : null
            api.call('get', '/api/companies', request )
            .then(function (response) {
                if(response.status == 200){
                    response.data.companies.forEach((value, index, self) =>
                        response.data.companies[index].tags = (value.tags != null) ? value.tags.replace(/[{}"']/g, '').split(',') : ''
                    )
                    currentObj.items = response.data.companies
                    currentObj.loading = false
                }
            })
            .catch(function (error) {
                console.log(error)
            });
        },

        companyDelete ( id = null) {
            let that = this
            const options = {title: 'Confirm delete?', cancelLabel: 'No', size: 'sm'}
            this.$dialogs.confirm('Are you sure you want to delete the selected company!', options)
            .then(res => {
                if(res.ok === true) {
                    api.call('delete', '/api/company/' + id)
                        .then(function (response) {
                            if(response.status == 200) {
                                that.loadCompanies()
                                // that.$parent.items.push({'id': response.data.company.id, 'name' : response.data.company.name, 'desc' : response.data.company.desc})
                            }
                    })
                    .catch(function (error) {
                        that.loadCompanies()
                            console.log(error)
                    });
                }


            })

        }
    }
}
</script>

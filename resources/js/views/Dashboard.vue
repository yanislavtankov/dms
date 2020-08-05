<template>
<div class="container vertical-center mt-5" >
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h3>Companies</h3></div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <span v-bind:class="{ yesItems: companies }" class="bigNum">{{ companies }}</span>
                        </div>
                        <div class="d-flex justify-content-center">
                            <span class="yesItems" v-if="this.companies>0">You have {{ companies }} companies</span>
                            <span class="noItems" v-else>You don't have any companies added yet</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-center">
                            <b-button @click="$router.push('/companies')" v-if="this.companies>0">Go to companies</b-button>
                            <b-button @click="$router.push('/companies')" v-else>Create a new company</b-button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h3>Files</h3></div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <span v-bind:class="{ yesItems: files }"  class="bigNum">{{ files }}</span>
                        </div>
                        <div class="d-flex justify-content-center">
                            <span class="yesItems" v-if="this.files>0">You have {{ files }} files</span>
                            <span class="noItems" v-else>You don't have any files uploaded yet</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-center">
                            <b-button v-if="this.files>0" @click="$router.push('/files')">Go to files</b-button>
                            <b-button @click="$router.push('/files')" v-else>Upload new files/s</b-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                companies: 0,
                files: 0
            }
        },

        methods: {
            loadCompanies () {
                let currentObj = this
                api.call('get', '/api/companies')
                .then(function (response) {
                    if(response.status == 200){
                        currentObj.companies = response.data.companies.length
                    }
                })
                .catch(function (error) {
                    console.log(error)
                });
            },

            loadFiles ( id = 0) {
                let currentObj = this
                api.call('get', '/api/files/' + id)
                .then(function (response) {
                    if(response.status == 200){
                       currentObj.files = response.data.files.length
                    }
                })
                .catch(function (error) {
                    console.log(error)
                });
            },
        },

        mounted() {
            this.loadCompanies()
            this.loadFiles(0)
        }
    }
</script>

<style>
.bigNum {
    font-size: 100px;
    font-weight: 600;
}

.noItems {
    color: red;
}

.yesItems {
    color: darkgreen;
}

</style>

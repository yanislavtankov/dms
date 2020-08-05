<template>
    <div>
        <modal :show="show" :companyData="companyData" @close="close">
            <div class="modal-header">
                <h4>Companies</h4>
            </div>
            <form
                id="app"
                @submit="formSubmit"
                enctype="multipart/form-data"
                novalidate="true"
            >
            <div class="modal-body">
                <label for="name">Company name</label>
                <input
                    type="text"
                    class="form-control"
                    name="name"
                    v-model="name"
                >
                <label for="description">Description</label>
                <input
                    type="text"
                    class="form-control"
                    name="description"
                    v-model="description"
                >
                <label for="tags">Tags</label>
                <vue-tags-input
                    class="form-control"
                    v-model="tag"
                    name="tags"
                    :tags="tags"
                    :autocomplete-items="autocompleteItems"
                    @tags-changed="updateTags"
                />

            </div>
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
        </modal>
    </div>
</template>

<script>
import VueTagsInput from '@johmun/vue-tags-input';
    export default {
        components: {
            VueTagsInput,
        },

        props: ['show', 'companyData'],

        data: function () {
            return {
                id: 0,
                name: '',
                description: '',
                tag: '',
                tags: [],
                autocompleteItems: [],
                debounce: null,
                action: 'new',
                disabled: true,
            };
        },

        watch: {
            'tag': 'initAutocompleteItems',
            'companyData': 'switchAction',
            'name' : 'enableSave',
            'description' : 'enableSave',
        },

        methods: {
            close: function () {
                this.$emit('close');
                if(this.action == 'new'){
                    this.id = 0,
                    this.name = '';
                    this.description = '';
                    this.tag = '';
                    this.tags = [];
                }
            },

            enableSave () {
                this.disabled = !(this.name && this.description)
            },

            normalizeTags ( inputArray = []) {
                if(typeof inputArray == 'undefined' || inputArray.length == 0) return []
                var outputArray = []
                inputArray.forEach(function(entry) {
                    outputArray.push({"text":entry})
                });
                return outputArray
            },

            switchAction () {
                if ( this.$props.companyData ) {
                    this.action = 'edit'
                    this.id = this.$props.companyData.id
                    this.name = this.$props.companyData.name
                    this.description = this.$props.companyData.desc
                    this.tags = this.normalizeTags(this.$props.companyData.tags)
                } else {
                    this.id = 0
                    this.action = 'new'
                    this.name = ''
                    this.description = ''
                    this.tags = []
                }
            },

            formSubmit: function () {
                var apiURL = (this.action == 'new' && this.id == 0) ? '/api/company' : '/api/company/' + this.id
                let that = this
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
                var tagsArr = Array()

                this.tags.forEach((value, index, self) =>
                    tagsArr.push(value.text)
                )

                let formData = new FormData();
                formData.append('name', this.name);
                formData.append('description', this.description);
                formData.append('tags',tagsArr);

                api.call('post', apiURL, formData, config)
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

            updateTags (newTags) {
                this.autocompleteItems = [];
                this.tags = newTags;
            },

            initAutocompleteItems() {
                if (this.tag.length < 2) return;
                let currentObj = this;
                clearTimeout(this.debounce);
                this.debounce = setTimeout(() => {
                api.call('get', '/api/tags')
                    .then(function (response) {
                        currentObj.autocompleteItems = response.data.map(a => {
                            return { text: a };
                        });
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
                }, 600);

            }

        }
    }
</script>

<style lang="css">
  .ti-input {
   display: block;
    width: 100%;
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
  }

  .vue-tags-input {
      padding: 0;
      border:none;
  }

  </style>

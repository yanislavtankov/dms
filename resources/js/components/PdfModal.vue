<template>
    <div>
        <modal :show="show" :fileName="fileName" @close="close" :modalType="modalType" >
            <div class="modal-header">
                <h4>Pdf {{ fileName }}</h4>
            </div>

            <div class="modal-body">
                <embed v-bind:src= "this.fileName" type="application/pdf" width="100%" height="400px">
            </div>

            <div class="modal-footer text-right">
                <b-button
                    size="md float-right mb-3"
                    @click="close()">Close</b-button>
            </div>

        </modal>
    </div>
</template>

<script>
    export default {
        props: ['show', 'fileName', 'modalType'],
        methods: {
            close: function () {
                this.$emit('close')
                this.$parent.fileName = ''
            },

            resizeModal () {
                this.$parent.modalWidth = '90%'
            }



        },

        watch: {
            'show' : 'resizeModal'
        }
    }
</script>

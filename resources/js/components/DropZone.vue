<template>
    <div>
        <vue-dropzone ref="myVueDropzone"
                      id="dropzone"
                      :options="dropzoneOptions"
                      v-on:vdropzone-removed-file="removeFile"
                      v-on:vdropzone-success="attachId"
                      :class="validationError ? 'dz-error' : '' "
        ></vue-dropzone>
        <p class="help is-danger" v-if="validationError">{{ validationError }}</p>
    </div>
</template>

<script>
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'
    import axios from 'axios'

    export default {
        props: ['uuid', 'uploads', 'error'],
        components: {
            vueDropzone: vue2Dropzone
        },
        data: function () {
            return {
                dropzoneOptions: {
                    url: `http://fileforrest.local/${this.uuid}/upload`,
                    createImageThumbnails: false,
                    addRemoveLinks: true,
                    maxFilesize: 2,
                    headers: {
                        "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]").content
                    }
                },
                validationError: this.error
            }
        },
        methods: {
            removeFile(file) {
                return axios.delete(`http://fileforrest.local/${this.uuid}/files/${file.id}`)
                    .catch((err) => {
                        if (err.response.data.error) {
                            this.validationError = err.response.data.message
                        }
                        this.addFile(file);
                    });
            },

            attachId(file, response) {
                file.id = response.id
            },

            populateDropzone(files) {
                files.map(file => {
                    this.$refs.myVueDropzone.manuallyAddFile({
                        size: file.size,
                        name: file.filename.split(/_(.+)/)[1],
                        id: file.id
                    }, "");
                });
            },

            addFile(file) {
                this.$refs.myVueDropzone.manuallyAddFile({
                    id: file.id,
                    name: file.name,
                    size: file.size
                },"")
            }
        },


        mounted() {
            this.populateDropzone(this.uploads);
        }
    }
</script>

<style>
    .dz-error {
        border: 1px solid red;
    }
</style>
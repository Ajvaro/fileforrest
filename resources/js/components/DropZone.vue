<template>
    <vue-dropzone ref="myVueDropzone"
                  id="dropzone"
                  :options="dropzoneOptions"
                  v-on:vdropzone-removed-file="removeFile"
                  v-on:vdropzone-success="attachId"
    ></vue-dropzone>
</template>

<script>
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'
    import axios from 'axios'

    export default {
        props: ['uuid', 'uploads'],
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
            }
        },
        methods: {
            removeFile(file) {
                return axios.delete(`http://fileforrest.local/${this.uuid}/files/${file.id}`)
                    .catch(() => {
                        this.$refs.myVueDropzone.manuallyAddFile({
                            id: file.id,
                            name: file.name,
                            size: file.size
                        })
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
            }
        },

        mounted() {
            this.populateDropzone(this.uploads);
        }
    }
</script>
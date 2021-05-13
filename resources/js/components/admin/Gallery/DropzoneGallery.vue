<template>
    <div class="container-form-dropzone-gallery">
        <div v-show="loader" class="loader-gif">
            <img src="/img/tpl_img/ajax.gif" class="ajax-loader"/>
        </div>
        <div v-html="message" class="message-gallery"></div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h6 class="panel-title">Выберите изображения</h6>
            </div>

            <div class="panel-body">

                <!--------- Dropzone Gallery ------------>
                <vue-dropzone
                    v-on:vdropzone-sending="dropzoneSendingEvent"
                    v-on:vdropzone-mounted="dropzoneMountedEvent"
                    v-on:vdropzone-canceled="dropzoneFileCanceledEvent"
                    v-on:vdropzone-success="dropzoneFileUploadedEvent"
                    ref="dropzoneGallery" id="dropzone"
                    :options="dropzoneOptions">

                </vue-dropzone>
                <!--------- End Dropzone Gallery ------------>

            </div>


            <div class="d-flex flex-row mt-2 align-items-center">


                <a @click="uploadFiles" style="color: #fff" class="btn btn-primary btn-lg m-auto button-upload"><i
                    class="fas fa-download mr-2"></i>Загрузить файлы</a>
            </div>
        </div>


    </div>
</template>

<script>
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'


export default {
    name: "DropzoneGallery",
    props: ['idGallery', 'nameGallery'],
    components: {
        vueDropzone: vue2Dropzone
    },
    mounted() {

        console.log("this.$refs.dropzoneGallery");
        console.log(this.$refs.dropzoneGallery);

    },
    computed: {},
    data() {
        return {
            message: "",
            loader: false,
            dropzoneOptions: {
                paramName: "image",
                url: '/api/v1/dropzone/upload',
                thumbnailWidth: 150,
                autoProcessQueue: false,
                addRemoveLinks: true,
                uploadMultiple: false,
                dictDefaultMessage: "UPLOAD ME <i class='fas fa-download'></i>",
                maxFilesize: '1000000',
                parallelUploads: 200,
                headers: {"My-Awesome-Header": "header value"}
            }
        }
    },
    methods: {
        uploadFiles() {
            this.$refs.dropzoneGallery.dropzone.processQueue();
        },
        dropzoneSendingEvent(file, xhr, formDara) {
            formDara.append("alt", this.nameGallery);
            formDara.append("id_gallery", this.idGallery);
        },
        dropzoneMountedEvent() {
            console.log("dropzone смонтирован");
        },

        //// Срабатывает когда файл успешно загружен на сервер
        dropzoneFileUploadedEvent(file, response) {

            // console.log("file, response");
            // console.log(file, response);

//// После успешно загрузки файла на сервер удаляем его из Dropzone
            this.$refs.dropzoneGallery.dropzone.removeFile(file);
            this.$emit('onFileUploaded', {file: file, response: response});

        },
        dropzoneFileCanceledEvent(file) {
            this.$emit('onFileCanceled', {file: file});
            console.log(file);
        }


    }
}
</script>

<style lang="scss">
.container-form-dropzone-gallery {
    .dropzone-custom-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    .dropzone-custom-title {
        margin-top: 0;
        color: #00b782;
    }

    .subtitle {
        color: #314b5f;
    }
}
</style>

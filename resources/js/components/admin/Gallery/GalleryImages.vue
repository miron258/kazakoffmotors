<template>
    <div class="container-form-list-images-gallery">
        <div v-html="message" class="message-gallery"></div>
        <dropzone-gallery @onFileUploaded="getImages" :name-gallery="nameGallery" :id-gallery="idGallery"></dropzone-gallery>


        <div class="panel panel-default">
            <div class="panel-heading">
                <h6 class="panel-title">Загруженные изображения</h6>
            </div>
            <div class="panel-body" id="uploaded_images">
                <!----------- list images ------------->
                <div class="list-images row">
                    <div v-show="loader" class="loader-gif">
                        <img src="/img/tpl_img/ajax.gif" class="ajax-loader"/>
                    </div>

                    <div v-if="form.images.length>0" v-for="(image,index) in form.images" class="col-2 card">

                        <form @keydown="form.onKeydown($event)" @submit.prevent="submit(image.id)" method="post">
                            <div class="card-img mt-2" style="height: 200px;overflow: hidden;">
                                <img :src="image.pathImg" class="card-img-top img-fluid"/>
                            </div>
                            <div class="card-body">
                                <div v-bind:class="{'has-error' : form.errors.has(`images.${index}.alt`)}"
                                     class="form-group form-row">
                                    <input :class="{ 'is-invalid': form.errors.has(`images.${index}.alt`) }"
                                           v-model="form.images[index].alt" :key="index" type="text" :name="`images.${index}.alt`" class="form-control"
                                           placeholder="ALT Описание">
                                    <has-error :form="form" :field="`images.${index}.alt`"></has-error>
                                </div>
                                <div v-bind:class="{'has-error' : form.errors.has(`images.${index}.position`)}"
                                     class="form-group form-row">
                                    <input :class="{ 'is-invalid': form.errors.has(`images.${index}.position`) }"
                                           v-model="form.images[index].position" :key="index" type="text" :name="`images.${index}.position`" class="form-control"
                                           placeholder="Позиция">
                                    <has-error :form="form" :field="`images.${index}.position`"></has-error>
                                </div>
                                <button @click="deleteImg(image.id)" type="button"
                                        class="btn w-100 btn-danger remove-image mt-2"><i class="fas fa-trash mr-2"></i>Удалить
                                </button>
                                <button type="submit" class="btn w-100 btn-success save-image  mt-2">
                                    <i class="fas fa-save mr-2"></i>Сохранить
                                </button>
                            </div>
                        </form>

                    </div>


                    <div v-else>
                        <p>Не загружено ни одного изображения!</p>
                    </div>

                    <!----------- End list images ------------->
                </div>
            </div>

        </div>
    </div>
</template>

<script>
//Import v-from
import {Form, HasError, AlertError, AlertErrors, AlertSuccess} from 'vform'
import axios from "axios";
import DropzoneGallery from "./DropzoneGallery";

export default {
    name: "GalleryImages",
    props: ['idGallery', 'nameGallery'],
    components: {
        Form,
        axios,
        DropzoneGallery,
        HasError,
        AlertError,
        AlertErrors,
        AlertSuccess
    },
    mounted() {

        this.getImages();


    },
    computed: {},
    data() {
        return {
            message: null,
            loader: false,
            form: new Form({
                images: []
            })
        }
    },
    methods: {
        hide() {

        },

        deleteImg(idImg) {
            this.loader = true;
            axios.delete('/api/v1/dropzone/delete/' + idImg).then(
                response => {
                    let status = response.data.success;
                    this.message = response.data.message;
                    if (status) {
                        this.getImages();
                    }


                    console.log(response);


                }).catch(e => {
            }).finally(() => {
                this.loader = false;
            });
        },


        getImages() {

            console.log("словили событие конца загрузки файла");

            this.loader = true;

            axios.get('/api/v1/dropzone/images/' + this.idGallery).then(
                response => {
                    let status = response.data.success;
                    this.message = response.data.message;
                    if (status) {
                        this.form.images = response.data.images;
                    }


                    console.log(response);


                }).catch(e => {
            }).finally(() => {
                this.loader = false;
            });

        },

        submit(idImg) {

            this.loader = true;
            //Отправляем введенные данные на сервер через библиотеку AXIOS
            this.form.post('/api/v1/dropzone/save/' + idImg)
                .then(response => {

                    let status = response.data.success;
                    this.message = response.data.message;
                    if (status) {

                    }


                    console.log(response);
                })
                .finally(() => (this.loader = false));


        }
    }
}
</script>

<style lang="scss">
.container-form-list-images-gallery {


    .list-images {
        position: relative;

        /****************** AJAX LOADER *******************/
        .loader-gif {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1000;
            background-color: #fff;
            opacity: 0.8;

            .ajax-loader {
                position: absolute;
                left: 0;
                right: 0;
                top: 50%;
                transform: translateY(-50%);
                margin-left: auto;
                margin-right: auto;
                display: block;
            }
        }

        /****************** END AJAX LOADER *******************/


    }

}
</style>

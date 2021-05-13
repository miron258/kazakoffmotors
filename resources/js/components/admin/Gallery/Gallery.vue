<template>
    <div class="container-form-gallery">
        <gallery-images :name-gallery="nameGallery" :id-gallery="idGallery"></gallery-images>
    </div>
</template>

<script>
import GalleryImages from "./GalleryImages";

export default {
    name: "Gallery",
    props: ['idGallery', 'nameGallery'],
    components: {
        GalleryImages,
    },
    mounted() {


    },
    computed: {},
    data() {
        return {
            message: null,
            loader: false,

        }
    },
    methods: {}
}
</script>

<style lang="scss">
.container-form-dropzone-gallery {

}
</style>

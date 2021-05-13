<template>
  <div v-if="isLoading">
    <div v-for="(gallery, index) in galleries" class="row box-gallery box-gallery-1">

      <!------------------------ BLOCK SLICK CAROUSEL ------------------------->
      <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 block-images-gallery">

        <div class="row">

          <div
              class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12 block-images-gallery__box-list-img box-list-img">
            <div class="nav-arrows" v-if="isNav" :class="setClassNav(index)"></div>
            <SlickCarouselCustomGallery
                :class-slick="setClassSlickCarousel(index)"
                :class-nav="setClassNav(index)"
                :class-dots="setClassDots(index)"
                :is-nav="isNav"
                :refGallery="setRefGallery(index)"
                :images="gallery.images"
                :is-dots="isDots">
            </SlickCarouselCustomGallery>
          </div>

          <div v-if="isThumbnails" class="col-xl-2 col-lg-2 col-md-2 box-list-thumbnails-img">
            <SlickCarouselCustomGalleryThumbnails
                :images="gallery.images"
                :class-slick="setClassSlickCarousel(index)"
            >
            </SlickCarouselCustomGalleryThumbnails>
          </div>

        </div>


      </div>
      <!------------------------ END BLOCK SLICK CAROUSEL ------------------------->


      <!------------------------ BLOCK DESCRIPTION GALLERY ------------------------->
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 block-description-gallery">
        <h3 v-text="gallery.header" class="block-description-gallery__title-gallery title-gallery"></h3>
        <div v-html="gallery.description" class="block-description-gallery__text-gallery text-gallery">
        </div>
        <div class="block-description-gallery__block-view-readmore block-view-readmore">
          <button v-text="gallery.name" class="block-view-readmore__link-readmore link-readmore"></button>
          <div v-text="gallery.datePublish"
               class="block-view-readmore__date-publish-gallery date-publish-gallery"></div>
        </div>
      </div>
      <!------------------------ END BLOCK DESCRIPTION GALLERY ------------------------->

    </div>

  </div>
</template>

<script>
import SlickCarouselCustomGallery from '../SlickCarouselCustomGallery'
import SlickCarouselCustomGalleryThumbnails from '../SlickCarouselCustomGalleryThumbnails'
import axios from "axios";

export default {
  name: 'SlickCarouselPortfolio',
  props: {
    idGallery: {
      type: Number,
      required: true
    },
    // ref: {
    //   type: String,
    //   required: true
    // },
    isChild: {
      type: Boolean,
      required: false,
      default: true
    },
    isNav: {
      type: Boolean,
      required: false,
      default: true
    },
    isDots: {
      type: Boolean,
      required: false,
      default: false
    },
    isThumbnails: {
      type: Boolean,
      required: false,
      default: true
    },
    classNav: {
      type: String,
      required: false,
      default: "nav-arrows"
    },
    classSlickCarousel: {
      type: String,
      required: false,
      default: "slick-carousel"
    },
    classDots: {
      type: String,
      required: false,
      default: "dots"
    },

  },
  //Данные которые мы выводим и применяем в шаблоне
  data() {
    return {
      message: null,
      isLoading: false,
      isParent: false,
      galleries: null
    }
  },
  mounted() {
    this.getGallery();
  },

  methods:
      {

        setClassNav(index) {
          return this.classNav + "" + index;
        },
        setClassDots(index) {
          return this.classDots + "" + index;
        },
        setRefGallery(index) {
          return "ref" + index;
        },
        setClassSlickCarousel(index) {
          return this.classSlickCarousel + "" + index;
        },


        getGallery() {
          axios.get('/api/v1/getGallery/' + this.idGallery).then(
              response => {
                let status = response.data.success;
                let message = response.data.message;
                if (status) {
                  let isParent = response.data.isParent;
                  if (isParent) {
                    this.isParent = true;
                    this.galleries = response.data.galleries;
                  } else {
                    this.galleries = response.data.galleries;
                  }

                  this.isLoading = true;
                  // console.log("Ответ");
                  // console.log(this.galleries);


                }

                console.log(response);


              }).catch(e => {
          }).finally(() => {
            this.isLoading = true;
          });
        }


      },
  components: {
    SlickCarouselCustomGallery,
    SlickCarouselCustomGalleryThumbnails,
    axios
  }
}
</script>
<style lang="scss">


</style>

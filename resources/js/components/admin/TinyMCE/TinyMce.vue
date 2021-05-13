<template>

        <editor
            :value="value"
            :name="name"
            api-key="labvll5ial6f1tgcacmkdk1sx2toj0ri402z1vvsf7o7dkrt"
            :init="{
         height: 500,
         menubar: false,
         plugins: [
           'advlist autolink lists link image charmap print preview hr anchor pagebreak',
           'searchreplace wordcount visualblocks visualchars code fullscreen',
           'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern'
         ],
         toolbar:
           'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | \
           bullist numlist outdent indent | link image media |  removeformat | help\ '
       }"
        />

</template>

<script>
import Editor from '@tinymce/tinymce-vue'


export default {
    name: "TinyMce",
    props: ["value", "name", "rows"],
    components: {
        'editor': Editor
    },
    mounted() {


    },
    computed: {},
    data() {
        return {}
    },
    methods: {}
}
</script>

<style lang="scss">
.container-form-tinymce {

}
</style>

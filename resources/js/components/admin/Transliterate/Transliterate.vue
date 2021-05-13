<template>
    <input :placeholder="placeholder"
           v-model="valueUrl"
           id="url"
           :name="name"
           v-bind:class="classError"
           class="form-control"
           :type="type">
</template>

<script>

export default {
    name: "Transliterate",
    watch: {
        valueComputed: function (newVal, oldVal) {

            console.log("изменилось значение");
            console.log(newVal, oldVal);

        },
        valueUrl: function (newVal, oldVal) {

            console.log("изменилось значение");
            console.log(newVal, oldVal);

        },
    },
    props: ['name', 'value', 'placeholder', 'type', 'classError'],
    components: {},
    mounted() {

    },

    computed: {
        valueComputed: function () {
            return this.$root.$refs["productName"].value;
        }
    },
    data() {
        return {
            valueUrl: this.value
        }
    },
    methods: {
        setUrl(){
            this.valueUrl = this.transliterate(this.$root.$refs["productName"].value);
        },
        transliterate(word) {
            let a = {"Ё":"YO", " ":"-9v ","Й":"I","Ц":"TS","У":"U","К":"K","Е":"E","Н":"N","Г":"G","Ш":"SH","Щ":"SCH","З":"Z","Х":"H","Ъ":"'","ё":"yo","й":"i","ц":"ts","у":"u","к":"k","е":"e","н":"n","г":"g","ш":"sh","щ":"sch","з":"z","х":"h","ъ":"'","Ф":"F","Ы":"I","В":"V","А":"a","П":"P","Р":"R","О":"O","Л":"L","Д":"D","Ж":"ZH","Э":"E","ф":"f","ы":"i","в":"v","а":"a","п":"p","р":"r","о":"o","л":"l","д":"d","ж":"zh","э":"e","Я":"Ya","Ч":"CH","С":"S","М":"M","И":"I","Т":"T","Ь":"'","Б":"B","Ю":"YU","я":"ya","ч":"ch","с":"s","м":"m","и":"i","т":"t","ь":"'","б":"b","ю":"yu"};
            return word.split('').map(function (char) {
                return a[char] || char;
            }).join("");
        }
    }
}
</script>

<style lang="scss">

</style>

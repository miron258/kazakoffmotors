<template>


    <nav class="header__mobile-menu mobile-menu" id="menu">
        <div  v-html="mMenuHtml" class="mobile-menu__mobile-panel-menu mobile-panel-menu">
        </div>
    </nav>
<!--    <nav class="mobile-menu" id="menu">-->
<!--        <div class="wrapper-mmenu" v-html="mMenuHtml"></div>-->


<!--    </nav>-->
</template>

<script>
import 'mmenu-js/dist/mmenu.css'
import 'mmenu-js/dist/mmenu.js'


export default {
    name: "MmenuMobile",
    props: {
        //Сформированное динамическое в виде JSON
        mMenu: {
            type: Object,
            required: true
        }
    },
    computed: {},
    components: {},
    mounted() {


        // console.log(this.mMenu['mmenu']);


        const panelMmenu = document.querySelector('#menu');
        const mMenu = new Mmenu("#menu", {
            // "autoHeight": true,
            extensions: [  "position-right",
                "position-front", "fullscreen"],
            // configuration
            // panelNodetype: ["ul", "ol", "div", "section"],
            navbar: {
                add: true,
                "sticky": false,
                title: ""
            },
            "navbars": [

                {
                    title: "",
                    position: "bottom",
                    content: [
                        "<a class='link-menu-phone' href='tel:+74957664703'>+7 (495) 766-47-03</a>"
                    ]
                },
//            {
//                title: "",
//                position: "bottom",
//                content: [
//                    "<div class='block-menu-address block-menu-address-top'><div class='header-address header-address-top'>Адрес площадки</div><a target='_blank' class='link-address link-address-top' href='https://yandex.ru/maps/213/moscow/?l=sat%2Cskl&ll=37.432205%2C55.754400&mode=search&oid=224259165876&ol=biz&z=18'>г. Москва, улица Крылатская,<br> дом 5, Гребной канал</a></div>"
//
//                ]
//            },
                {
                    title: "",
                    position: "bottom",
                    content: [
                        "<div class='block-menu-address block-menu-address-bottom'><div class='header-address header-address-bottom'>Адрес мотосервиса</div><a target='_blank' class='link-address link-address-bottom' href='https://yandex.ru/maps/213/moscow/?ll=37.519171%2C55.788940&mode=search&oid=1484362205&ol=biz&sctx=ZAAAAAgBEAAaKAoSCSujkc8rCEJAEVD%2B7h01fEpAEhIJ%2FmDgufdwzz8R98jmqnmOwj8iBQABAgQFKAAwATj7h9zo6p6H%2BfoBQApIAVXNzMw%2BWABiJG1pZGRsZV9hc2tfZGlyZWN0X3F1ZXJ5X3R5cGVzPXJ1YnJpY2IQcmVsZXZfbm9xdW9ydW09MGIobWlkZGxlX2luZmxhdGVfZGlyZWN0X2ZpbHRlcl93aW5kb3c9NTAwMGIScmVsZXZfZHJ1Z19ib29zdD0xYkRtaWRkbGVfZGlyZWN0X3NuaXBwZXRzPXBob3Rvcy8yLngsYnVzaW5lc3NyYXRpbmcvMi54LG1hc3N0cmFuc2l0LzEueGI0bWlkZGxlX3dpemV4dHJhPXRyYXZlbF9jbGFzc2lmaWVyX3ZhbHVlPTAuMzc3NzgzOTU0MWInbWlkZGxlX3dpemV4dHJhPWFwcGx5X2ZlYXR1cmVfZmlsdGVycz0xYihtaWRkbGVfd2l6ZXh0cmE9b3JnbW5fd2FuZF90aHJlc2hvbGQ9MC45YiltaWRkbGVfd2l6ZXh0cmE9cmVxdWVzdF9zb2Z0X3RpbWVvdXQ9MC4wNWIjbWlkZGxlX3dpemV4dHJhPXRyYW5zaXRfYWxsb3dfZ2VvPTFiPm1pZGRsZV93aXpleHRyYT10cmF2ZWxfY2xhc3NpZmllcl9vcmdtYW55X3ZhbHVlPTAuMDA5NzMyMDgyNDg2YiptaWRkbGVfaW5mbGF0ZV9kaXJlY3RfcmVxdWVzdF93aW5kb3c9MTAwMDBiHm1pZGRsZV9hc2tfZGlyZWN0X3Blcm1hbGlua3M9MWIdcmVsZXZfZmlsdGVyX2d3a2luZHM9MC4zLDAuNDViKXJlYXJyPXNjaGVtZV9Mb2NhbC9HZW8vQWxsb3dUcmF2ZWxCb29zdD0xYjFyZWFycj1zY2hlbWVfTG9jYWwvR2VvdXBwZXIvZmVhdHVyZXNGcm9tT2JqZWN0cz0xYi9yZWFycj1zY2hlbWVfTG9jYWwvR2VvL1Bvc3RmaWx0ZXIvQWJzVGhyZXNoPTAuMmIpcmVhcnI9c2NoZW1lX0xvY2FsL0dlby9DdXRBZmlzaGFTbmlwcGV0PTFiNXJlYXJyPXNjaGVtZV9Mb2NhbC9HZW8vSG90ZWxCb29zdD1tZWFuX2NvbnZlcnNpb25fMTJ3YilyZWFycj1zY2hlbWVfTG9jYWwvR2VvL1VzZUdlb1RyYXZlbFJ1bGU9MWoCcnVwAZUBAAAAAJ0BzcxMPqABAagBAL0B6A5TssIBBd2j5sMF0gFA0L%2FRgNC%2B0LXQt9C0INCx0LXRgNC10LfQvtCy0L4HKNC5Bykg0YDQvtGJ0LggMTAg0LrQsNC30LDQutC%2B0YTRhNgBkE4%3D&sll=37.519171%2C55.788940&source=wizbiz_new_map_single&text=проезд%20березовой%20рощи%2010%20казакофф&z=14'>Проезд Березовой Рощи дом 10</a></div>"

                    ]
                },

                {
                    title: "",
                    position: "bottom",
                    content: [
                        '<div class="list-social-icon"><a rel="nofollow" target="_blank" class="item__item-link item-link" href="https://vk.com/public36588859"> <img alt="Мы в Контакте" title="Мы в Контакте" src="/img/tpl_img/mobile/social_icon/vk.png"> </a><a rel="nofollow" target="_blank" class="item__item-link item-link" href="https://www.facebook.com/groups/371914162843244"> <img alt="Мы на Facebook" title="Мы на Facebook" src="/img/tpl_img/mobile/social_icon/facebook.png"> </a><a rel="nofollow" target="_blank" class="item__item-link item-link" href="https://www.youtube.com/channel/UCGH42q0LFfl12N2qWUb2v3gg"> <img alt="Мы на Youtube" title="Мы на Youtube" src="/img/tpl_img/mobile/social_icon/youtube.png"> </a></div>'
                    ]
                }
            ]


        });

        // const api = mMenu.API;
        //
        // api.initPanel( panelMmenu );



    },
    data() {
        return {
            mMenuHtml: this.mMenu['mmenu']
        }
    },
    methods:
        {}
}
</script>

<style lang="scss">


</style>

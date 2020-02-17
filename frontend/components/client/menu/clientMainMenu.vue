<template>
    <div class="sm-flex col sm-bg-dark sm-color-white sm-p-3 cs-client-menu"
         :class="showMenu ? 'full' : 'short'">

        <div class="sm-flex right sm-mobile-hide">
            <i class="mdi mdi-menu cs-link-menu-head fnt-size-3"
               @click="showMenu = !showMenu"></i>
        </div>

        <n-link v-for="(val,key) in menus"
                :key="key"
                :to="val.link"
                exact
                active-class="cs-link-menu-head-active"
                class="sm-flex middle cs-link-menu-head sm-pb-2"
                :title="showMenu ? '' : lang(val.name)">
            <i :class="'mdi mdi-'+val.icon"
               class="sm-mr-3 fnt-size-3"></i>

            <div :class="showMenu ? 'sm-show' : 'sm-hide'">
                {{ lang(val.name) }}
            </div>
        </n-link>

    </div>
</template>

<script>
    export default {
        name: "clientMainMenu",

        created() {
        },

        mounted() {
        },

        props: {},

        data() {
            return {
                showMenu: true,

                menus: [
                    {name: 'menu_client.back_on_site', icon: 'arrow-left', link: '/', show: true},
                    {name: 'menu.home', icon: 'home', link: '/client', show: true},
                    {name: 'project.projects', icon: 'domain', link: '/client/projects', show: true},
                    {name: 'menu_client.new_order', icon: 'plus-box', link: '/1', show: true},
                    {name: 'menu_client.orders', icon: 'file-multiple', link: '/2', show: true},
                    {name: 'all.history', icon: 'history', link: '/3', show: true},
                    {name: 'all.reports', icon: 'file-chart', link: '/4', show: true},
                ]
            }
        },

        computed: {},

        watch: {},

        methods: {}
    }
</script>